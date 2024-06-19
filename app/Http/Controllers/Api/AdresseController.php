<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adresse;

class AdresseController extends Controller
{
    public function index(){
        return "ici sera erigé la liste des adresses";
    }
    public function create(Request
    $_adresse){
        $adresse= new Adresse();
        $adresse->adresse=$_adresse->adresse;
        $adresse->quartier=$_adresse->quartier;
        $adresse->commune="chicago";
        $adresse->ville="new york";
        $adresse->province="tshikapa";
        $adresse->numero="15";
        $adresse->save();
        return "ça etait crée";
    }
}
