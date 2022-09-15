<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookmarkResource;
use App\Models\Bookmark;
use App\Models\Folder;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class BookmarkController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bm = DB::table('Bookmark')->join('Folder','Bookmark.Folder', '=','Folder.ID')->where('Folder.WebUser','=', Auth::user()->id)->select("Bookmark.*")->get();

        return $this->sendResponse(BookmarkResource::collection($bm),"Bookmarks trouvés avec succès");
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            "Name"=> "required|max:255",
            "Comment" => "max:255",
            "URL"=> "required|max:1023|url",
            "ImgUrl"=> "max:1023|url",
            "Folder"=> "integer"
        ]);

        if($validator->fails()){
            return $this->sendError("Validation error",$validator->errors(),400);
        }
        $folder = Folder::findorfail($input["Folder"]);
        if(!Gate::allows(("access-folder"),$folder)){
            return $this->sendError("Unauthorized access to folder","Unauthorized access to folder",403);
        }
        
        $bookmark = new Bookmark($input);
        $bookmark->CreationDate = now();
        $bookmark->save();
        return $this->sendResponse(new BookmarkResource($bookmark), "Bookmark créé avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function show(Bookmark $bookmark)
    {
        if(!Gate::allows('access-bookmark',$bookmark)){
            return $this->sendError(null,"Unauthorized access to bookmark",403);
        }
        return $this->sendResponse(new BookmarkResource($bookmark),"found with success");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bookmark $bookmark)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            "Name"=> "required|max:255",
            "Comment" => "max:255",
            "URL"=> "required|max:1023|url",
            "ImgUrl"=> "max:1023|url",
            "Folder"=> "integer|required"
        ]);

        if($validator->fails()){
            return $this->sendError("Validation error",$validator->errors(),400);
        }
        if(!Gate::allows("access-bookmark",$bookmark)){
            return $this->sendError(null,"Unauthorized access to bookmark",403);
        }
        if($input["Folder"]!= $bookmark->Folder){
            $folder = Folder::findorfail($input["Folder"]);

            if(!Gate::allows("access-folder",$folder)){
                return $this->sendError(null,"Unauthorized access to parent folder",403);
            }
        }

        $bookmark->Name = $input["Name"] ?? null;
        $bookmark->Comment = $input["Comment"] ?? null;
        $bookmark->URL = $input["URL"] ?? null;
        $bookmark->ImgUrl = $input["ImgUrl"] ?? null;
        $bookmark->Folder = $input["Folder"] ?? null;
        $bookmark->save();


        return $this->sendResponse($folder,"Updated with success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bookmark $bookmark)
    {
        if(!Gate::allows("access-bookmark",$bookmark)){
            return $this->sendError(null,"Unauthorized access to bookmark",403);
        }
        $bookmark->delete();
        return $this->sendResponse(null,"deleted with success");
    }
}
