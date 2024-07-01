<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class UtilisateurLoginRequest extends FormRequest
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
            "nom_utilisateur"=>"required|string|exists:utilisateurs,nom_utilisateur",
            "password"=>"required"
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
        return [
             "nom_utilisateur.required"=>"Le champs nom_utilisateur est vide",
             "nom_utilisateur.string"=>"Les contenus saisit dans nom_utilisateur n'est pas une chaine de caractere",
             "nom_utilisateur.exists"=>"La personne n'existe pas",
             "password.required"=>"Le champs password est vide",
        ];
    }
}
