<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class AgentEditorRequest extends FormRequest
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
            "name_agent.string"=>"Les contenus saisit dans le name_agent n'est pas une chaine de caractere",
            "name_agent.max"=>"Les textes saisit depasse la limitation recommandée",
            "prenom_agent.string"=>"Les contenus saisit dans le prenom_agent n'est pas une chaine de caractere",
            "prenom_agent.max"=>"Les textes saisit depasse la limitation recommandée",
            "e_mail_agent.string"=>"Les contenus saisit dans e_mail_agent n'est pas une chaine de caractere",
            "e_mail_agent.max"=>"Les textes saisit depasse la limitation recommandée",
            "e_mail_agent.unique"=>"Ce e_mail_agent est déjà utilisé",
            "phone_agent.integer"=>"Les contenus saisit dans la usd n'est pas un nombre",
            "phone_agent.unique"=>"Le champs ne peut pas etre vide au moins 0",
            "phone_agent.regex"=>"Le champs ne peut pas etre vide au moins 0",
            "fonction.string"=>"Les contenus saisit dans fonction n'est pas une chaine de caractere",
            "fonction.max"=>"Les textes saisit depasse la limitation recommandée",
        ];
    }
}
