<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agent;
use App\Http\Requests\Api\AgentCreateRequest;
use App\Http\Requests\Api\AgentEditorRequest;
use Exception;
use App\Models\Adresse;
use App\Models\Agence;

class AgentController extends Controller
{
    public function index (Request $req){
        $query=Agence::query();
        $persopage=25;
        $page=$req->input("page",1);
        $search=$req->input("search");
        if ($search){
            $query->whereRaw("name_agent LIKE '%"
            .$search."%' OR prenom_agent LIKE '%"
            .$search."%' OR phone_agence LIKE '%"
            .$search."%' OR e_mail_agent LIKE '%"
            .$search."%' OR date_de_naissance LIKE '%"
            .$search."%' OR fonction LIKE '%"
            .$search. "%'");
        }
        $total=$query->count();
        $result=$query->offset(($page-1)*$persopage)->limit($persopage)->get();
        try {
            return response()->json([
                "Status_code"=>200,
                "Status_message"=>"Recuperation d'agent reussi",
                "current_page"=>$page,
                "last_page"=>ceil($total/$persopage),
                "items"=>$result
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
    public function create(AgentCreateRequest $req){
        
        try{
        $agent_agence=Agence::find($req->id_agence);
        $agent_adresse=Adresse::find($req->id_adresse);
        if(!$agent_adresse){
            return response()->json([
                "Success"=>false,
                "Error"=>true,
                "Message"=>"ça n'as pas aboutis",
                "Erros list"=>"L'adresse n'as pas été trouvé"
        ],500);
        }
        if(!$agent_agence){
            return response()->json([
                "Success"=>false,
                "Error"=>true,
                "Message"=>"ça n'as pas aboutis",
                "Erros list"=>"L'adresse n'as pas été trouvé"
        ],500);
        }
        $nouvelle_agent= new Agent();
        $nouvelle_agent->name_agent=$req->name_agent;
        $nouvelle_agent->prenom_agent=$req->prenom_agent;
        $nouvelle_agent->e_mail_agent=$req->e_mail_agent;
        $nouvelle_agent->phone_agent=$req->phone_agent;
        $nouvelle_agent->date_de_naissance=$req->date_de_naissance;
        $nouvelle_agent->fonction=$req->fonction;
        $nouvelle_agent->id_adresse=$agent_adresse->id;
        $nouvelle_agent->id_agence=$agent_agence->id;
        $nouvelle_agent->save();
        return response()->json([
            "Status_code"=>201,
            "Status_message"=>"L'agent a étais ajouté",
            "Data"=>$nouvelle_agent
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
    public function editor(AgentEditorRequest $req, Agent $Agent){
               
        try {
            $agent_agence=Agence::find($req->id_agence);
            $agent_adresse=Adresse::find($req->id_adresse);            
            if(!$agent_adresse){
                return response()->json([
                    "Success"=>false,
                    "Error"=>true,
                    "Message"=>"L'agent n'as pas pu etre modifier",
                    "Erros list"=>"L'agent n'a pas étais changé"
            ],500);
            }
            if(!$agent_agence){
                return response()->json([
                    "Success"=>false,
                    "Error"=>true,
                    "Message"=>"L'agent n'as pas pu etre modifier",
                    "Erros list"=>"L'agent n'a pas étais changé"
            ],500);
            }
            $Agent->name_agent=$req->name_agent;
            $Agent->prenom_agent=$req->prenom_agent;
            $Agent->e_mail_agent=$req->e_mail_agent;
            $Agent->phone_agent=$req->phone_agent;
            $Agent->date_de_naissance=$req->date_de_naissance;
            $Agent->fonction=$req->fonction;
            $Agent->id_adresse=$agent_adresse->id;
            $Agent->id_adresse=$agent_agence->id;
            $Agent->save();
            }catch(Exception $error){
                return response()->json([
                    "Success"=>false,
                    "Error"=>true,
                    "Message"=>"ça n'as pas aboutis",
                    "Erros list"=>$error
            ],500);
            }
        }
        public function delete(Agent $Agent){
            
            try{
                $Agent->delete();
                return response()->json([
                    "Status_code"=>200,
                    "Status_message"=>"La suppremion à été effectué",
                    "Data"=>$Agent
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
