<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRegisterRequest;
use App\Models\User;
class UserController extends Controller
{
   public function register(UserRegisterRequest $req){
         $nouveau_user=new User();
         $nouveau_user->name=$req->name;
         $nouveau_user->email=$req->email;
         $nouveau_user->password=$req->password;
         $nouveau_user->save();
   }
}
