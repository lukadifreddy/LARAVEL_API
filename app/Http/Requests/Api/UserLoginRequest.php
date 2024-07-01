<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class UserLoginRequest extends FormRequest
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
            "email"=>"required|string|exists:users,email",
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
             "email.required"=>"Le champs email est vide",
             "email.string"=>"Les contenus saisit dans email n'est pas une chaine de caractere",
             "email.exists"=>"La personne n'existe pas",
             "password.required"=>"Le champs password est vide",
        ];
    }
}
