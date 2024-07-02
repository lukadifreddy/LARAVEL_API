<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class ExterneEditorRequest extends FormRequest
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
        return[
            "nom_externe.string"=>"Les contenus saisit dans le nom_externe n'est pas une chaine de caractere",
            "nom_externe.max"=>"Les textes saisit depasse la limitation recommandée",
            "fonction_externe.string"=>"Les contenus saisit dans le fonction_externe n'est pas une chaine de caractere",
            "fonction_externe.max"=>"Les textes saisit depasse la limitation recommandée",
            "motif.string"=>"Les textes saisit depasse la limitation recommandée",
            "motif.max"=>"Cet e_mail_client est déjà utilisé",
        ];
    }
}
