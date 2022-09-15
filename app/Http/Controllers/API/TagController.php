<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Folder;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class TagController extends BaseController
{
    
    public function GetTagsOFFolder(Folder $folder){
        if(!Gate::allows("access-folder",$folder)){
           return $this->sendError("Unauthorized access to folder","Unauthorized access to folder $folder->ID",403);
        }
        $tags = Tag::GetTagsOfFolder($folder);
        return $this->sendResponse(["tags"=>$tags],"tags trouvés avec succès");
    }

    public function GetTagsOfBookmark(Bookmark $bookmark){
        if(!Gate::allows("access-bookmark",$bookmark)){
           return $this->sendError("Unauthorized access to bookmark","Unauthorized access to bookmark $bookmark->ID",403);
        }
        $tags = Tag::GetTagsOfBookmark($bookmark);
        return $this->sendResponse(["tags"=>$tags],"tags trouvés avec succès");
    }

    public function GetTagsOfUser(){
        $tags = Tag::GetTagsOfUser(Auth::user());
        return $this->sendResponse(["tags"=>$tags],"tags trouvés avec succès");
    }

    public function UpdateTagsOfBookmark(Request $request, Bookmark $bookmark){

        $input = $request->all();

        if(!array_key_exists("tags",$input)) return $this->sendError("Bad request", "Should contain a \"tags\" value.",400);

        if(is_array($input["tags"])){
            foreach($input["tags"] as $item){
                if(!is_string($item)) return $this->sendError("Bad request", "Tags should only contain strings", 400);
            }
        }
        else return $this->sendError("Bad request", "Tags should be an array of strings",400);
        if(!Gate::allows("access-bookmark",$bookmark)){
           return $this->sendError("Unauthorized access to bookmark","Unauthorized access to bookmark $bookmark->ID",403);
        }
        Tag::SetTagsOfBookmark($bookmark,$input["tags"]);

        return $this->sendResponse(["tags"=>$input["tags"]],"Tags updated with success",200);


    }
    public function UpdateTagsOfFolder(Request $request, Folder $folder){
        $input = $request->all();

        if(!array_key_exists("tags",$input)) return $this->sendError("Bad request", "Should contain a \"tags\" value.",400);

        if(is_array($input["tags"])){
            foreach($input["tags"] as $item){
                if(!is_string($item)) return $this->sendError("Bad request", "Tags should only contain strings", 400);
            }
        }
        else return $this->sendError("Bad request", "Tags should be an array of strings",400);

        
        if(!Gate::allows("access-folder",$folder)){
           return $this->sendError("Unauthorized access to bookmark","Unauthorized access to bookmark $folder->ID",403);
        }
        Tag::SetTagsOfFolder($folder,$input["tags"]);

        return $this->sendResponse(["tags"=>$input["tags"]],"Tags updated with success",200);
    }
}
