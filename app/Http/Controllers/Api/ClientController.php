<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Requests\Api\ClientCreateRequest;
use Exception;
use App\Http\Requests\Api\ClientEditorRequest;
use App\Models\Adresse;

class ClientController extends Controller
{
    public function index (Request $req){
        $query=Agence::query();
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
    public function create(ClientCreateRequest $req){
        
        try{
        $client_adresse=Adresse::find($req->id_adresse);
        $nouvelle_client= new Agent();
        $nouvelle_client->nom_client=$req->nom_client;
        $nouvelle_client->prenom_client=$req->prenom_client;
        $nouvelle_client->phone_client=$req->phone_client;
        $nouvelle_client->phone_agent=$req->phone_agent;
        $nouvelle_client->e_mail_client=$req->e_mail_client;
        $nouvelle_client->document=$req->document;
        $nouvelle_client->id_adresse=$Client_adresse->id;
        $nouvelle_client->save();
        return response()->json([
            "Status_code"=>201,
            "Status_message"=>"L'agent a étais ajouté",
            "Data"=>$nouveau_client
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
    public function editor(ClientEditorRequest $req, Client $Client){
               
        try {
            $Client_adresse=Adresse::find($req->id_adresse);            
            if(!$client_adresse){
                return response()->json([
                    "Success"=>false,
                    "Error"=>true,
                    "Message"=>"Le client n'as pas pu etre modifier",
                    "Erros list"=>" Le client n'a pas étais changé"
            ],500);
            }
            $Client->nom_client=$req->nom_client;
            $Client->prenom_client=$req->prenom_client;
            $Client->phone_client=$req->phone_client;
            $Client->e_mail_client=$req->e_mail_client;
            $Client->document=$req->document;
            $Client->id_adresse=$req->client_adresse;
            $Client->save();

            }catch(Exception $error){
                return response()->json([
                    "Success"=>false,
                    "Error"=>true,
                    "Message"=>"ça n'as pas aboutis",
                    "Erros list"=>$error
            ],500);
            }
     
        }
        public function delete(Client $client){
            
            try{
                $client->delete();
                return response()->json([
                    "Status_code"=>200,
                    "Status_message"=>"La suppremion à été effectué",
                    "Data"=>$client
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
