<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class AdresseEditorRequest extends FormRequest
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
             
             "avenue.string"=>"Les contenus saisit dans avenue n'est pas une chaine de caractere",
             "avenue.max"=>"Les textes saisit depasse la limitation recommandée",
             "quartier.string"=>"Les contenus saisit dans quartier n'est pas une chaine de caractere",
             "quartier.max"=>"Les textes saisit depasse la limitation recommandée",
             "commune.string"=>"Les contenus saisit dans commune n'est pas une chaine de caractere",
             "commune.max"=>"Les textes saisit depasse la limitation recommandée",
             "ville.string"=>"Les contenus saisit dans ville n'est pas une chaine de caractere",
             "ville.max"=>"Les textes saisit depasse la limitation recommandée",
             "province.string"=>"Les contenus saisit dans province n'est pas une chaine de caractere",
             "province.max"=>"Les textes saisit depasse la limitation recommandée",
             "numero.string"=>"Les contenus saisit dans numero n'est pas une chaine de caractere",
             "numero.max"=>"Les textes saisit depasse la limitation recommandée",
        ];
    }
}
