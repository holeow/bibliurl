<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

    public function postuser(Request $request){
        if(Auth::user()->isadmin) {
            $input = $request->all();
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                
            ])->validate();

            $us = User::create(['isadmin'=>false ,"name"=> $input['name'], "email"=> $input['email'], "password"=> Hash::make($input['password'])]);
            return redirect("admin/userlist");
        }
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

    public function banuser(User $user){
        if(Auth::user()->isadmin){
            $user->delete();
            return redirect("admin/userlist");
        }else return "Vous devez être administrateur pour accéder à cette page";
    }
}
