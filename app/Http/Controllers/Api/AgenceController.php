<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agence;
use App\Http\Requests\Api\AgenceCreateRequest;
use Exception;
use App\Http\Requests\Api\AgenceEditorRequest;
use App\Models\Adresse;

class AgenceController extends Controller
{
    public function index (){
        return "Ici sera Dressé la liste des Agences";
    }
    public function create(AgenceCreateRequest $req){
        
        try{
        $agence_adresse=Adresse::find($req->id_adresse);
        if(!$agence_adresse){
            return response()->json([
                "Success"=>false,
                "Error"=>true,
                "Message"=>"ça n'as pas aboutis",
                "Erros list"=>"L'adresse n'as pas été trouvé"
        ],500);
        }
        $nouvelle_agence= new Agence();
        $nouvelle_agence->nom_agence=$req->nom_agence;
        $nouvelle_agence->code_agence=$req->code_agence;
        $nouvelle_agence->phone_agence=$req->phone_agence;
        $nouvelle_agence->usd=$req->usd;
        $nouvelle_agence->cdf=$req->cdf;
        $nouvelle_agence->id_adresse=$agence_adresse->id;
        $nouvelle_agence->save();
        return response()->json([
            "Status_code"=>201,
            "Status_message"=>"L'agence a été ajouté",
            "Data"=>$nouvelle_agence
        ],201);
        }catch(Exception $error){
            return response()->json([
                "Success"=>false,
                "Error"=>true,
                "Message"=>"ça n'as pas aboutis",
                "Erros list"=>$error
        ],500);
        }
    }
    public function editor(AgenceEditorRequest $req, Agence $Agence){
               
        try {
            $agence_adresse=Adresse::find($req->id_adresse);            
            if(!$agence_adresse){
                 return response()->json([
                    "Success"=>false,
                    "Error"=>true,
                    "Message"=>"ça n'as pas aboutis",
                    "Erros list"=>"L'agence n'as pas été changé"
            ],500);
            }
            $Agence->nom_agence=$req->nom_agence;
            $Agence->code_agence=$req->code_agence;
            $Agence->phone_agence=$req->phone_agence;
            $Agence->usd=$req->usd;
            $Agence->cdf=$req->cdf;
            $Agence->id_adresse=$agence_adresse->id;
            $Agence->save();

            }catch(Exception $error){
                return response()->json([
                    "Success"=>false,
                    "Error"=>true,
                    "Message"=>"ça n'as pas aboutis",
                    "Erros list"=>$error
            ],500);
            }
     
        }
        public function delete(Agence $Agence){
            
            try{
                $Agence->delete();
                return response()->json([
                    "Status_code"=>200,
                    "Status_message"=>"La suppremion à été effectué",
                    "Data"=>$Agence
                ],200);

            }catch(Exception $error){
                return response()->json([
                    "Success"=>false,
                    "Error"=>true,
                    "Message"=>"la suppression n'as pas aboutis",
                    "Erros list"=>$error
            ],500);
            }
        }
};
