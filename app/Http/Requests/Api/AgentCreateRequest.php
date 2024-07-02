<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class AgentCreateRequest extends FormRequest
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
            "name_agent"=>"required|string|max:45",
            "prenom_agent"=>"required|string|max:45",
            "e_mail_agent"=>"email|max:60|unique:agent",
            "phone_agent"=>"required|integer|max:15|unique:agent|regex:",
            "date_de_naissance"=>"required|date",
            "fonction"=>"required|string|max:45",
            "document_agent"=>"required|file|mimes:pdf,docx|max:10240",
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
    public function messages (){
        return [
        "name_agent.required"=>"Le champs name_agent est vide",
        "name_agent.string"=>"Les contenus saisit dans le name_agent n'est pas une chaine de caractere",
        "name_agent.max"=>"Les textes saisit depasse la limitation recommandée",
        "prenom_agent.required"=>"Le champs prenom_agent est vide",
        "prenom_agent.string"=>"Les contenus saisit dans le prenom_agent n'est pas une chaine de caractere",
        "prenom_agent.max"=>"Les textes saisit depasse la limitation recommandée",
        "e_mail_agent.string"=>"Les contenus saisit dans e_mail_agent n'est pas une chaine de caractere",
        "e_mail_agent.max"=>"Les textes saisit depasse la limitation recommandée",
        "e_mail_agent.unique"=>"Ce e_mail_agent est déjà utilisé",
        "phone_agent.required"=>"Le champs ne peut pas etre vide au moins 0",
        "phone_agent.integer"=>"Les contenus saisit dans la usd n'est pas un nombre",
        "phone_agent.unique"=>"Le champs ne peut pas etre vide au moins 0",
        "phone_agent.regex"=>"Le champs ne peut pas etre vide au moins 0",
        "fonction.required"=>"Le champs fonction est vide",
        "fonction.string"=>"Les contenus saisit dans fonction n'est pas une chaine de caractere",
        "fonction.max.required"=>"Les textes saisit depasse la limitation recommandée",
        "document_agent.file"=>"Le contenus n'est pas un fichier",
        "document_agent.mimes"=>"Ce fichier n'est pas un PDF ou DOCX",
        "document_agent.max"=>"Le fichier ne doit pas depassé le 10Mo",
        ];
        
    }
}
