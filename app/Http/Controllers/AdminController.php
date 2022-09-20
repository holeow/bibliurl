<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        if(Auth::user()->isadmin) return view("admin/index");
        else return "Vous devez être administrateur pour accéder à cette page";
    }

    public function userlist(){

        if(Auth::user()->isadmin){
            $users = User::all();

            return view("admin/userlist")->with('users', $users);
        }
        else{
             return "Vous devez être administrateur pour accéder à cette page";
        }
       
    }

    public function createuser(){
        
        if(Auth::user()->isadmin)return view("admin/createuser");
        else return "Vous devez être administrateur pour accéder à cette page";
    }

    public function postuser(){
        if(Auth::user()->isadmin) return redirect("admin/userlist");
        else return "Vous devez être administrateur pour accéder à cette page";
    }

    public function makeadmin(User $user){
        if(Auth::user()->isadmin){
            $user->isadmin = true;
            $user->save();
            return redirect("admin/userlist");
        }
        else return "Vous devez être administrateur pour accéder à cette page";
        
    }
}
