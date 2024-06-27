<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class AgenceEditorRequest extends FormRequest
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
            
        ];
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            "Success"=>false,
            "Error"=>true,
            "Message"=>"La modificcation n'a pas aboutis",
            "Erros list"=>$validator->errors()
        ],400));
    }
    public function messages(){
        return [
             "nom_agence.string"=>"Les contenus saisit dans le nom d'agence n'est pas une chaine de caractere",
             "nom_agence.max"=>"Les textes saisit depasse la limitation recommandée",
             "nom_agence.unique"=>"Ce nom existe déjà",
             "code_agence.string"=>"Les contenus saisit dans le code d'agence n'est pas une chaine de caractere",
             "code_agence.max"=>"Les textes saisit depasse la limitation recommandée",
             "code_agence.unique"=>"Ce nom existe déjà",
             "phone_agence.string"=>"Les contenus saisit dans le telephone agence n'est pas une chaine de caractere",
             "phone_agence.max"=>"Les textes saisit depasse la limitation recommandée",
             "phone_agence.unique"=>"Ce nom existe déjà",
             "usd.integer"=>"Les contenus saisit dans la usd n'est pas un nombre",
             "usd.unique"=>"Ce nom existe déjà",
             "cdf.integer"=>"Les contenus saisit dans la cdf n'est pas un nombre",
             "cdf.unique"=>"Ce nom existe déjà",
        ];
    }
}
