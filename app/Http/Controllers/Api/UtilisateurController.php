<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Http\Requests\Api\UtilisateurCreateRequest;
use Exception;
use App\Http\Requests\Api\UtilisateurEditorRequest;
use App\Http\Requests\Api\UtilisateurLoginRequest;
use App\Models\Agent;
use App\Models\Externe;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UtilisateurController extends Controller
{
    public function index (){
        return "Ici sera Dressé la liste des Utilisateurs";
    }
    public function create(UtilisateurCreateRequest $req){
        
        try{
        $id_utilisateur_Agent=agent::find($req->id_agent);
        $id_utilisateur_Externe=externe::find($req->id_externe);
        if($req->id_agent==null && $req->id_externe==null){
            return response()->json([
                "Success"=>false,
                "Error"=>true,
                "Message"=>"ça n'as pas aboutis",
                "Erros list"=>"l'utilisateur n'a pas étais trouvé"
        ],422);
        }
        if($id_utilisateur_Agent && $id_utilisateur_Externe ){
            return response()->json([
                "Success"=>false,
                "Error"=>true,
                "Message"=>"ça n'as pas aboutis",
                "Erros list"=>"tu ne peux pas etre à la fois agent et externe"
        ],500);
        }
        if(!$id_utilisateur_Agent && !$id_utilisateur_Externe ){
            return response()->json([
                "Success"=>false,
                "Error"=>true,
                "Message"=>"ça n'as pas aboutis",
                "Erros list"=>"Agent et Externe n'ont pzs etait trouvé dans la base donnnée"
        ],500);
        }
        $nouvelle_utilisateur= new Utilisateur();
        if($id_utilisateur_Agent){
          
            $nouvelle_utilisateur->id_agent=$id_utilisateur_Agent->id;
        }
        if ($id_utilisateur_Externe){
            
           
            $nouvelle_utilisateur->id_externe=$id_utilisateur_Externe->id;
        }
        $nouvelle_utilisateur->nom_utilisateur=$req->nom_utilisateur;
        $nouvelle_utilisateur->password=Hash::make($req->password,['rounds'=>15]);
        $nouvelle_utilisateur->save();
        return response()->json([
            "Status_code"=>201,
            "Status_message"=>"L'Utilisateur a étais ajouté",
            "Data"=>$nouvelle_utilisateur
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
    
    public function editor(UtilisateurEditorRequest $req, Utilisateur $Utilisateur){
               
        try {
            $Utilisateur_Adresse=Adresse::find($req->id_adresse);            
            if(!$utilisateur_Adresse){
                return response()->json([
                    "Success"=>false,
                    "Error"=>true,
                    "Message"=>"L'Utilisateur n'as pas pu etre modifier",
                    "Erros list"=>"L'Utilisateur n'a pas étais changé"
            ],500);
            }

            $Utilisateur->name_Utilisateur=$req->name_Utilisateur;
            $Utilisateur->password=$req->prenom_Utilisateur;
            $Utilisateur->e_mail_Utilisateur=$req->e_mail_Utilisateur;
            $Utilisateur->fonction=$req->fonction;
            $Utilisateur->save();

            }catch(Exception $error){
                return response()->json([
                    "Success"=>false,
                    "Error"=>true,
                    "Message"=>"ça n'as pas aboutis",
                    "Erros list"=>$error
            ],500);
            }
     
        }
        public function delete(Utilisateur $Utilisateur){
            
            try{
                $Utilisateur->delete();
                return response()->json([
                    "Status_code"=>200,
                    "Status_message"=>"La suppremion à été effectué",
                    "Data"=>$Utilisateur
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
