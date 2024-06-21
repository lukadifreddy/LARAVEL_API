<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class AdresseCreateRequest extends FormRequest
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
           "avenue"=>"required|string|max:45",
           "quartier"=>"required|string|max:45",
           "commune"=>"required|string|max:45",
           "ville"=>"required|string|max:45",
           "province"=>"required|string|max:45",
           "numero"=>"required|string|max:45",
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
             "avenue.required"=>"Le champs avenue est vide",
             "avenue.string"=>"Les contenus saisit dans avenue n'est pas une chaine de caractere",
             "avenue.max"=>"Les textes saisit depasse la limitation recommandée",
             "quartier.required"=>"Le champs quartier est vide",
             "quartier.string"=>"Les contenus saisit dans quartier n'est pas une chaine de caractere",
             "quartier.max"=>"Les textes saisit depasse la limitation recommandée",
             "commune.required"=>"Le champs commune est vide",
             "commune.string"=>"Les contenus saisit dans commune n'est pas une chaine de caractere",
             "commune.max"=>"Les textes saisit depasse la limitation recommandée",
             "ville.required"=>"Le champs ville est vide",
             "ville.string"=>"Les contenus saisit dans ville n'est pas une chaine de caractere",
             "ville.max"=>"Les textes saisit depasse la limitation recommandée",
             "province.required"=>"Le champs province est vide",
             "province.string"=>"Les contenus saisit dans province n'est pas une chaine de caractere",
             "province.max"=>"Les textes saisit depasse la limitation recommandée",
             "numero.required"=>"Le champs numero est vide",
             "numero.string"=>"Les contenus saisit dans numero n'est pas une chaine de caractere",
             "numero.max"=>"Les textes saisit depasse la limitation recommandée",
        ];
    }
     
}
