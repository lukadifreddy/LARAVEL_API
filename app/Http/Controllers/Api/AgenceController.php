<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agence;
use App\Http\Requests\Api\AgenceCreateRequest;
use Exception;

class AgenceController extends Controller
{
    public function index (){
        return "Ici sera Dressé la liste des Agences";
    }
    public function create(AgenceCreateRequest $req){

        try{
            $nouvelle_agence=new Agence();
        $nouvelle_agence->nom_agence=$req->nom_agence;
        $nouvelle_agence->code_agence=$req->code_agence;
        $nouvelle_agence->phone_agence=$req->phone_agence;
        $nouvelle_agence->usd=$req->usd;
        $nouvelle_agence->cdf=$req->cdf;
        $nouvelle_agence->save();
        return response->json([
            "Status_code"=>201,
            "Status_message"=>"L'agence a été ajouté",
            "Data"=>$nouvelle_agence
        ],201);
        }catch(Exception $error){
            return  response()->json([
                "Success"=>false,
                "Error"=>true,
                "Message"=>"ça n'as pas aboutis",
                "Erros list"=>$error
            ],500);
        }
    }
};
