<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Externe;
use App\Http\Requests\Api\ExterneCreateRequest;
use Exception;
use App\Http\Requests\Api\ExterneEditorRequest;

class ExterneController extends Controller
{
    public function index (Request $req){
        $query=Externe::query();
        $persopage=25;
        $page=$req->input("page",1);
        $search=$req->input("search");
        if ($search){
            $query->whereRaw("nom_client LIKE '%"
            .$search."%' OR prenom_client LIKE '%"
            .$search."%' OR phone_client LIKE '%"
            .$search."%' OR e_mail_client LIKE '%"
            .$search."%' OR document LIKE '%"
            .$search."%' OR usd LIKE '%"
            .$search."%' OR cdf LIKE '%"
            .$search. "%'");
        }
        $total=$query->count();
        $result=$query->offset(($page-1)*$persopage)->limit($persopage)->get();   
    }
    public function create(ExterneCreateRequest $req){
        
        try{
        $nouveau_externe= new Externe();
        $nouveau_externe->nom_externe=$req->nom_externe;
        $nouveau_externe->fonction_externe=$req->fonction_externe;
        $nouveau_externe->motif=$req->motif;
        $nouveau_externe->save();
        return response()->json([
            "Status_code"=>201,
            "Status_message"=>"L'utilisateur externe a étais ajouté",
            "Data"=>$nouveau_externe
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
    public function editor(ExteeneEditorRequest $req, Externe $Externe){
               
        try {

            $Externe->name_Externe=$req->name_externe;
            $Externe->prenom_externe=$req->prenom_externe;
            $Externe->e_mail_externe=$req->e_mail_externe;
            $Externe->phone_externe=$req->phone_externe;
            $Externe->date_de_naissance=$req->date_de_naissance;
            $Externe->fonction=$req->fonction;
            $Externe->save();

            }catch(Exception $error){
                return response()->json([
                    "Success"=>false,
                    "Error"=>true,
                    "Message"=>"ça n'as pas aboutis",
                    "Erros list"=>$error
            ],500);
            }
     
        }
        public function delete(Externe $Externe){
            
            try{
                $Externe->delete();
                return response()->json([
                    "Status_code"=>200,
                    "Status_message"=>"La suppremion à été effectué",
                    "Data"=>$Externe
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
