<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRegisterRequest;
class UserController extends Controller
{
   public function register(UserRegisterRequest $req){
         dd($req);
   }
}
