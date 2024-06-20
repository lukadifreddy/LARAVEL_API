<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adresse;
use App\Http\Requests\Api\AdresseCreateRequest;

class AdresseController extends Controller
{
    public function index(){
        return "ici sera erigé la liste des adresses";
    }
    public function create(AdresseCreateRequest $req){
        $nouvelle_adresse= new Adresse();
        $nouvelle_adresse->avenue=$req->avenue;
        $nouvelle_adresse->quartier=$req->quartier;
        $nouvelle_adresse->commune=$req->commune;
        $nouvelle_adresse->ville=$req->ville;
        $nouvelle_adresse->province=$req->province;
        $nouvelle_adresse->numero=$req->numero;
        $nouvelle_adresse->save();
    }
};
