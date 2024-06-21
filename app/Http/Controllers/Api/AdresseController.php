<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adresse;
use App\Http\Requests\Api\AdresseCreateRequest;
use Exception;

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
    
};
