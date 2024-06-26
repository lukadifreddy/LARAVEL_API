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
    public function index(Request $req){
        $query=Adresse::query();
        $persopage=1;
        $page=$req->input("page",1);
        $search=$req->input("search");
        if ($search){
            $query->whereRaw("avenue LIKE '%"
            .$search."%' OR quartier LIKE '%"
            .$search."%' OR commune LIKE '%"
            .$search."%' OR ville LIKE '%"
            .$search."%' OR avenue LIKE '%"
            .$search."%' OR province LIKE '%"
            .$search."%' OR numero LIKE '%"
            .$search. "%'");
        }
        $total=$query->count();
        $result=$query->offset(($page-1)*$persopage)->limit($persopage)->get();
        try {
            return response()->json([
                "Status_code"=>200,
                "Status_message"=>"Recuperation d'adresse reussi",
                "Data"=>Adresse::all()
            ],200);
        } catch (Exception $error) {
            return response()->json([
                "Success"=>false,
                "Error"=>true,
                "Message"=>"ça n'as pas aboutis",
                "Erros list"=>$error
        ],500);
        }
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
