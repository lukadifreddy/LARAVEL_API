<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRegisterRequest;
use App\Http\Requests\Api\UserLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   public function register(UserRegisterRequest $req){
         $nouveau_user=new User();
         $nouveau_user->name=$req->name;
         $nouveau_user->email=$req->email;
         $nouveau_user->password=$req->password;
         $nouveau_user->save();
   }
   public function login(UserLoginRequest $req){
        
      try {
          
          if(auth()->attempt($req->only(['email','password']))){
            $user=auth()->user();
            $token=$user->createToken(env('TOKEN_JETON'))->plainTextToken;
            return response()->json([
                 "Statut_code"=>200,
                 "Success"=>true,
                 "Error"=>false,
                 "User"=>$user,
                 "Token"=>$token
            ],200);
      }
      else{
              return response()->json([
                  "Statut_code"=>404,
                  "Success"=>false,
                  "Error"=>true,
                  "Message"=>"l'nformation est non approuvée"
              ],404);
          }

      } catch (Exception $error) {
          return response()->json([
              "Success"=>false,
              "Error"=>true,
              "Message"=>"ça n'as pas aboutis",
              "Erros list"=>$error
      ],500);
      }
  }
}
