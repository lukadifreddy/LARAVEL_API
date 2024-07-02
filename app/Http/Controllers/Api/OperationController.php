<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Operation;
use App\Http\Requests\Api\OperationCreateRequest;
use Exception;
use App\Http\Requests\Api\OperationEditorRequest;
use App\Models\Adresse;
use App\Models\Agence;
use App\Models\Agent;
use App\Models\Client;

class OperationController extends Controller
{
    public function index (){
        $page=$req->input("page",1);
        $search=$req->input("search");
        if ($search){
            $query->whereRaw("montant LIKE '%"
            .$search."%' OR devise LIKE '%"
            .$search."%' OR commision LIKE '%"
            .$search."%' OR code_operation LIKE '%"
            .$search."%' OR etat LIKE '%"
            .$search."%' OR date_livraison LIKE '%"
              );
        }
        $total=$query->count();
        $result=$query->offset(($page-1)*$persopage)->limit($persopage)->get();  
    }
    public function create(OperationCreateRequest $req){
        
        try{
        $operation_adresse=Adresse::find($req->id_adresse);
        $operation_agence=Agence::find($req->id_agence);
        $operation_adresse=Agent::find($req->id_agent);
        $operation_agence=Client::find($req->id_client);
        $nouvelle_operation= new operation();
        $nouvelle_operation->montant=$req->montant;
        $nouvelle_operation->devise=$req->devise;
        $nouvelle_operation->commission=$req->commision;
        $nouvelle_operation->code_operation=$req->code_operation;
        $nouvelle_operation->etat=$req->etat;
        $nouvelle_operation->date_livraison=$req->date_livraison;
        $nouvelle_operation->id_adresse=$operation_adresse->id;
        $nouvelle_operation->id_agence=$operation_agence->id;
        $nouvelle_operation->id_agent=$operation_agent->id;
        $nouvelle_operation->id_client=$operation_client->id;
        $nouvelle_operation->save();
        return response()->json([
            "Status_code"=>201,
            "Status_message"=>"L'operation a étais ajouté",
            "Data"=>$nouvelle_operation
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
    public function editor(OperationEditorRequest $req, Operation $Operation){
               
        try {
            $operation_adresse=Adresse::find($req->id_adresse); 
            $operation_agence=Agence::find($req->id_agence);            
            $operation_agent=Agent::find($req->id_agent);            
            $operation_client=Client::find($req->id_client);            
        
            if(!$operation_adresse){
                return response()->json([
                    "Success"=>false,
                    "Error"=>true,
                    "Message"=>"L'operation n'as pas pu etre modifier",
                    "Erros list"=>"L'operation n'a pas étais changé"
            ],500);
            }
            if(!$operation_agence){
                return response()->json([
                    "Success"=>false,
                    "Error"=>true,
                    "Message"=>"L'operation n'as pas pu etre modifier",
                    "Erros list"=>"L'operation n'a pas étais changé"
            ],500);
            }
            if(!$operation_agent){
                return response()->json([
                    "Success"=>false,
                    "Error"=>true,
                    "Message"=>"L'operation n'as pas pu etre modifier",
                    "Erros list"=>"L'operation n'a pas étais changé"
            ],500);
            }
            if(!$operation_client){
                return response()->json([
                    "Success"=>false,
                    "Error"=>true,
                    "Message"=>"L'operation n'as pas pu etre modifier",
                    "Erros list"=>"L'operation n'a pas étais changé"
            ],500);
            }

            $Operation->montant=$req->name_operation;
            $Operation->devise=$req->prenom_operation;
            $Operation->commission=$req->e_mail_operation;
            $Operation->code_operation=$req->phone_operation;
            $Operation->etat=$req->date_de_naissance;
            $Operation->date_livraison=$req->date_de_naissance;
            $Operation->date_livraison=$req->date_de_naissance;
            $Operation->date_livraison=$req->date_de_naissance;
            $Operation->id_adresse=$operation_adresse->id;
            $Operation->id_agence=$operation_agence->id;
            $Operation->id_agent=$operation_agent->id;
            $Operation->id_client=$operation_client->id;
            $Operation->fonction=$req->fonction;
            $Operation->save();

            }catch(Exception $error){
                return response()->json([
                    "Success"=>false,
                    "Error"=>true,
                    "Message"=>"ça n'as pas aboutis",
                    "Erros list"=>$error
            ],500);
            }
     
        }
        public function delete(Operation $Operation){
            
            try{
                $Operation->delete();
                return response()->json([
                    "Status_code"=>200,
                    "Status_message"=>"La suppremion à été effectué",
                    "Data"=>$Operation
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
