<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Tag
{

    public static function GetTagsOfUser(User $user){

        $Bookmarktags = DB::table("Bookmark_Tag")
        ->join('Bookmark','Bookmark.ID', '=', 'Bookmark_Tag.Bookmark')
        ->join("Folder", 'Bookmark.Folder', '=', 'Folder.ID')
        ->where("Folder.WebUser",'=', $user->id)
        ->select("Bookmark_Tag.Tag as Tag");

        $FolderUnionBookmarkTags = DB::table("Folder_Tag")
        ->join('Folder', 'Folder.ID' ,'=', 'Folder_Tag.Folder')
        ->where("Folder.WebUser",'=', $user->id)
        ->select('Folder_Tag.Tag as Tag')
        ->union($Bookmarktags)
        ->get();

       

        $strs = [];

        foreach ($FolderUnionBookmarkTags as $value) {
            $strs[] = $value->Tag;
        }

        return $strs;
    }

    public static function GetTagsOfBookmark(Bookmark $bookmark){
        $tags = DB::table("Bookmark_Tag")
        ->where('Bookmark', '=', $bookmark->ID)
        ->select('Tag as Tag' )
        ->get();

        $strs = [];

        foreach ($tags as $value) {
            $strs[] = $value->Tag;
        }

        return $strs;
    }
    public static function GetTagsOfFolder(Folder $folder){
        $tags = DB::table("Folder_Tag")
        ->where('Folder', '=', $folder->ID)
        ->select('Tag as Tag' )
        ->get();

        $strs = [];

        foreach ($tags as $value) {
            $strs[] = $value->Tag;
        }

        return $strs;
    }

    public static function SetTagsOfBookmark(Bookmark $bookmark, array $tags){
        DB::table("Bookmark_Tag")->where("Bookmark",'=',$bookmark->ID)->whereNotIn('Tag',$tags)->delete();
        
        $data = [];
        foreach ($tags as $item) {
            $data[] = ["Bookmark"=> $bookmark->ID, "Tag" => $item];
        }

        DB::table("Bookmark_Tag")->insertOrIgnore($data);
    }

    public static function SetTagsOfFolder(Folder $folder, array $tags){
        DB::table("Folder_Tag")->where("Folder",'=',$folder->ID)->whereNotIn('Tag',$tags)->delete();
        
        $data = [];
        foreach ($tags as $item) {
            $data[] = ["Folder"=> $folder->ID, "Tag" => $item];
        }

        DB::table("Folder_Tag")->insertOrIgnore($data);
    }
}