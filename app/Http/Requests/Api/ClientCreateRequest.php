<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class ClientCreateRequest extends FormRequest
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
            "nom_client"=>"required|string|max:45",
            "prenom_client"=>"required|string|max:45",
            "phone_client"=>"required|integer|max:15|unique:client|regex:",
            "e_mail_client"=>"email|max:60|unique:client",
            "document"=>"file|mimes:pdf,docx|max:10240",
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
    public function messsages(){
        return[
            "nom_client.required"=>"Le champs nom_client est vide",
            "nom_client.string"=>"Les contenus saisit dans le nom_client n'est pas une chaine de caractere",
            "nom_client.max"=>"Les textes saisit depasse la limitation recommandée",
            "prenom_client.required"=>"Le champs prenom_client est vide",
            "prenom_client.string"=>"Les contenus saisit dans le prenom_client n'est pas une chaine de caractere",
            "prenom_client.max"=>"Les textes saisit depasse la limitation recommandée",
            "e_mail_client.email"=>"Les contenus saisit dans e_mail_client n'est pas un email",
            "e_mail_client.max"=>"Les textes saisit depasse la limitation recommandée",
            "e_mail_client.unique"=>"Cet e_mail_client est déjà utilisé",
            "phone_client.required"=>"Le champs ne peut pas etre vide au moins 0",
            "phone_client.integer"=>"Les contenus saisit dans phone_client n'est pas un nombre",
            "phone_client.max"=>"Les textes saisit depasse la limitation recommandée",
            "phone_client.unique"=>"Ce phone_client est déjà utilisé",
            "phone_client.regex"=>"Vous ne pouvez inseré que les types des numers recommandé",
            "document.required"=>"Le champs document est vide",
            "document.file"=>"Le contenus n'est pas un fichier",
            "document.mimes"=>"Ce fichier n'est pas un PDF ou DOCX",
            "document.max"=>"Le fichier ne doit pas depassé le 10Mo",
        ];
    }
}
