<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Folder;
use Illuminate\Http\Request;

class TagController extends BaseController
{
    
    public function GetTagsOFFolder(Folder $folder){

    }

    public function GetTagsOfBookmark(Bookmark $bookmark){

    }

    public function GetTagsOfUser(){

    }

    public function UpdateTagsOfBookmark(Request $request, Bookmark $bookmark){

    }
    public function UpdateTagsOfFolder(Request $request, Folder $folder){
        
    }
}
