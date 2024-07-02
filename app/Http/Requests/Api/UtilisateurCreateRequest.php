<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class UtilisateurCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "nom_utilisateur"=>"required|string|max:45",
            "password"=>"required|string|max:128|unique:utilisateur",
        ];
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            "Success"=>false,
            "Error"=>true,
            "Message"=>"Champs incorrects",
            "Erros list"=>$validator->errors()
        ],400));
    
    }
    public function messages(){
        return[
            "nom_utilisateur.required"=>"Le champ nom utilisateur est vide",
            "nom_utilisateur.string"=>"Le contenus de ce champ n'est pas une chaine de caractere",
            "nom_utilisateur.max"=>"Les contenus inserer depasse la limitation recommandée",
            "nom_utilisateur.required"=>"Le champ nom utilisateur est vide",
            "nom_utilisateur.string"=>"Le contenus de ce champ n'est pas une chaine de caractere",
            "nom_utilisateur.max"=>"Les contenus inserer depasse la limitation recommandée",
            "nom_utilisateur.unique"=>"Le nom_uy=tilisqteur existe déjà",
        ];
    }
}
