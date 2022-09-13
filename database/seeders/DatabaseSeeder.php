<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Bookmark;
use App\Models\Folder;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //!! Avant de pouvoir seed, il faut générer deux users depuis le site lui-même !

        $user1 = User::findorfail(1);
        DB::table('Folder')->delete();
        $f1 = Folder::create(["Name"=> "root", "WebUser" => 1]);
        $f1b = Folder::create(["Name"=> "root", "WebUser" => 2]);
        $f2 = Folder::create(["Name"=> "SQL", "WebUser" => 1, "Container" => $f1->ID]);
        $f2b = Folder::create(["Name"=> "private", "WebUser" => 2, "Container" => $f1b->ID]);
        $f3 = new Folder();
        $f3->Name = "MariaDB";
        $f3->user()->associate($user1);
        $f3->parent()->associate($f2);
        $f3->save();

        $f4 = new Folder(["Name"=>"C#"]);
        $f4->user()->associate($user1);
        $f1->folders()->save($f4);

        $b1 = Bookmark::Create(["Name"=> "Site vitrine","Comment"=> "hello", "URL"=> "http://vitrine.org", "CreationDate"=> now(),"ImgUrl"=> "http://url.com/1.png", "Folder"=> $f1->ID]);
        $b1b = Bookmark::Create(["Name"=> "Site vitrine d'holeo sur le compte aeclia","Comment"=> "hello", "URL"=> "http://vitrine.org", "CreationDate"=> now(),"ImgUrl"=> "http://url.com/1.png", "Folder"=> $f1b->ID]);

        $b2 = new Bookmark(["Name"=> "SELECT","Comment"=> "comment faire un select sql", "URL"=> "https://sql.sh/cours/select", "CreationDate"=> now()]);
        $b2->folder()->associate($f2);
        $b2->save();
        $b3 = new Bookmark(["Name"=> "INNER JOIN", "URL"=> "https://sql.sh/cours/jointures/inner-join", "CreationDate"=> now()]);
        $f2->bookmarks()->save($b3);

        $b4 = new Bookmark(["Name"=> "MariaDB knownledge base", "URL"=> "https://mariadb.com/kb/en/", "CreationDate"=> now()]);
        $f3->bookmarks()->save($b3);

        $folderTags = [
            ["Folder"=> $f2->ID, "Tag"=> "Langage"],
            ["Folder"=> $f2->ID, "Tag"=> "BDD"],
            ["Folder"=> $f3->ID, "Tag"=> "SGBD"],
            ["Folder"=> $f3->ID, "Tag"=> "BDD"],
            ["Folder"=> $f2b->ID, "Tag"=> "perso"]
        ];

        DB::table("Folder_Tag")->insertOrIgnore($folderTags);
        
        $bookmarkTags = [
            ["Bookmark"=> $b1->ID, "Tag"=> "perso"],
            ["Bookmark"=> $b1b->ID, "Tag"=> "perso"],
            ["Bookmark"=> $b2->ID, "Tag"=> "SGBD"],
            ["Bookmark"=> $b2->ID, "Tag"=> "BDD"],
            ["Bookmark"=> $b2->ID, "Tag"=> "Query"],
            ["Bookmark"=> $b3->ID, "Tag"=> "SGBD"],
            ["Bookmark"=> $b3->ID, "Tag"=> "BDD"],
            ["Bookmark"=> $b3->ID, "Tag"=> "Query"],
            ["Bookmark"=> $b4->ID, "Tag"=> "SGBD"],
            ["Bookmark"=> $b4->ID, "Tag"=> "BDD"]
        ];

        DB::Table("Bookmark_Tag")->insertOrIgnore($bookmarkTags);

    }
}
