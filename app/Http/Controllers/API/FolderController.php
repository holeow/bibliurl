<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FolderResource;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class FolderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fl = DB::table("Folder")->where("Folder.WebUser",'=',Auth::user()->id)->get();
        return $this->sendResponse(FolderResource::collection($fl),"Folders trouvés avec succès.");
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
            "Name" => "required|max:255",
            "ImgUrl"=> "url|max:1023",
            "Container"=> "integer|required"
        ]);
        if($validator->fails()){
            return $this->sendError("Validation  error", $validator->errors(),400);
        }

        $container = Folder::findorfail($input["Container"]);
        if(!Gate::allows("access-folder",$container)){
            return $this->sendError("Unauthorized access to folder","Unauthorized access to folder",403);

        }
        $folder = new Folder($input);
        $folder->WebUser = Auth::user()->id;
        $folder->save();
        return $this->sendResponse(new FolderResource($folder), "Folder créé avec succès");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder)
    {
        if(!Gate::allows("access-folder",$folder)){
            return $this->sendError(null,"Unauthorized access to folder",403);

        }
        return $this->sendResponse(new FolderResource($folder), "Folder créé avec succès");

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Folder $folder)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            "Name" => "required|max:255",
            "ImgUrl"=> "url|max:1023",
            "Container"=> "integer|required"
        ]);
        if($validator->fails()){
            return $this->sendError("Validation  error", $validator->errors(),400);
        }

        $container = Folder::findorfail($input["Container"]);
        if(!Gate::allows("access-folder",$container)){
            return $this->sendError("Unauthorized access to folder","Unauthorized access to folder",403);

        }

        $folder->Name = $input["Name"];
        $folder->ImgUrl = $input["ImgUrl"] ?? null;
        $folder->Container = $input["Container"];

        $folder->save();

        return $this->sendResponse($folder,"Updated with response");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Folder $folder)
    {
        if(!Gate::allows("access-folder", $folder)){
            return $this->sendError(null,"Unauthorized access to folder",403);

        }
        $folder->delete();
        return $this->sendResponse(null,"deleted with success");
    }
}
