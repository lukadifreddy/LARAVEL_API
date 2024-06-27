<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            "name"=>'required|string|max:45',
            "email"=>'required|string|max:45',
            "email_verified_at"=>'required|string|max:45',
            "password"=>'required|string|max:250',
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
         "name.required"=>"Le champs name est vide",
         "name.string"=>"Les contenus saisit dans name n'est pas une chaine de caractere",
         "name.max"=>"Les textes saisit depasse la limitation recommandée",
         "email.required"=>"Le champs dans email est vide",
         "email.string"=>"Les contenus saisit dans email n'est pas une chaine de caractere",
         "email.max"=>"Les textes saisit depasse la limitation recommandée",
         "email_verified_at.required"=>"Le champs email_verified_at est vide",
         "email_verified_at.string"=>"Les contenus saisit dans email_verified_at n'est pas une chaine de caractere",
         "email_verified_at.max"=>"Les textes saisit depasse la limitation recommandée",
         "password.required"=>"Le champs password est vide",
         "password.string"=>"Les contenus saisit dans password n'est pas une chaine de caractere",
         "password.max"=>"Les textes saisit depasse la limitation recommandée",
    ];
}
}
