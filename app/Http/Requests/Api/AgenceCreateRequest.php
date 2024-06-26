<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class AgenceCreateRequest extends FormRequest
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
            "nom_agence"=>"required|string|max:45|unique:agences",
            "code_agence"=>"required|string|max:2|unique:agences",
            "phone_agence"=>"required|string|max:15|unique:agences",
            "usd"=>"required|integer",
            "cdf"=>"required|integer",
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
             "nom_agence.required"=>"Le champs nom d'agence est vide",
             "nom_agence.string"=>"Les contenus saisit dans le nom d'agence n'est pas une chaine de caractere",
             "nom_agence.max"=>"Les textes saisit depasse la limitation recommandée",
             "nom_agence.unique"=>"Ce nom existe déjà",
             "code_agence.required"=>"Le champs code d'agence est vide",
             "code_agence.string"=>"Les contenus saisit dans le code d'agence n'est pas une chaine de caractere",
             "code_agence.max"=>"Les textes saisit depasse la limitation recommandée",
             "code_agence.unique"=>"Ce code existe déjà",
             "phone_agence.required"=>"Le champs telephone de l'agence est vide",
             "phone_agence.string"=>"Les contenus saisit dans commune n'est pas une chaine de caractere",
             "phone_agence.max"=>"Les textes saisit depasse la limitation recommandée",
             "phone_agence.unique"=>"Ce numero est déjà utilisé",
             "usd.required"=>"Le champs ne peut pas etre vide au moins 0",
             "usd.integer"=>"Les contenus saisit dans la usd n'est pas un nombre",
             "cdf.required"=>"Le champs ne peut pas etre vide au moins 0",
             "cdf.integer"=>"Les contenus saisit dans cdf n'est pas un nombre",
        ];
    }
}
