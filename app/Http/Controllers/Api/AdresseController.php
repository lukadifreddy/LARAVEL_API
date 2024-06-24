<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adresse;
use App\Http\Requests\Api\AdresseCreateRequest;
use Exception;
use App\Http\Requests\Api\AdresseEditorRequest;

class AdresseController extends Controller
{
    public function index(){
        return "Ici sera Dressé la liste des adresses";
    }
    public function create(AdresseCreateRequest $req){
        
        try{
            $nouvelle_adresse= new Adresse();
        $nouvelle_adresse->avenue=$req->avenue;
        $nouvelle_adresse->quartier=$req->quartier;
        $nouvelle_adresse->commune=$req->commune;
        $nouvelle_adresse->ville=$req->ville;
        $nouvelle_adresse->province=$req->province;
        $nouvelle_adresse->numero=$req->numero;
        $nouvelle_adresse->save();
        return response()->json([
            "Status_code"=>201,
            "Status_message"=>"L'adresse a été ajouté",
            "Data"=>$nouvelle_adresse
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
    public function editor(AdresseEditorRequest $req, Adresse $Adresse){
               
        try {
            $Adresse->avenue=$req->avenue;
            $Adresse->quartier=$req->quartier;
            $Adresse->commune=$req->commune;
            $Adresse->ville=$req->ville;
            $Adresse->province=$req->province;
            $Adresse->numero=$req->numero;
            $Adresse->save();

            }catch(Exception $error){
                return response()->json([
                    "Success"=>false,
                    "Error"=>true,
                    "Message"=>"ça n'as pas aboutis",
                    "Erros list"=>$error
            ],500);
            }
     
        }
        public function delete(Adresse $Adresse){
            
            try{
                $Adresse->delete();
                return response()->json([
                    "Status_code"=>200,
                    "Status_message"=>"La suppremion à été effectué",
                    "Data"=>$Adresse
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
