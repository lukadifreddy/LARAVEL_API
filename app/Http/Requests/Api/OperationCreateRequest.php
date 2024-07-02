<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class OperationCreateRequest extends FormRequest
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
            "montant"=>"required|float",
            "devise"=>"required|string|max:3",
            "commission"=>"required|float",
            "code_operation"=>"required|string|max:15|unique:operation",
            "etat"=>"required|string|max:10",
            "date_livraison"=>"required|datetime",
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
        return[
            "montant.required"=>"Le champ montant est vide",
            "montant.float"=>"Le montant inserer n'est pas recommandée ex:0.1,200.1",
            "devise.required"=>"Le champ devise est vide",
            "devise.string"=>"Le contenus de ce champ n'est pas une chaine de caractere",
            "devise.max"=>"Les contenus inserer depasse la limitation recommandée",
            "commission.required"=>"Le champ commission est vide",
            "commission.float"=>"La commission inserer n'est pas recommandée ex:0.1,200.1",
            "code_operation.required"=>"Le champ cope_oeration est vide",
            "code_operation.string"=>"Le contenus de ce champ n'est pas une chaine de caractere",
            "code_operation.max"=>"Les contenus inserer depasse la limitation recommandée",
            "code_operation.unique"=>"Le code de l'operation existe déjà",
            "etat.required"=>"le champ etat est vide",
            "etat.string"=>"Le contenus de ce champ n'est pas une chaine de caractere",
            "etat.max"=>"Les contenus inserer depasse la limitation recommandée",
            "date_livraison.required"=>"Le champ date de livraison est vite",
            "date_livraison.datetime"=>"La date de la livraison n'est pas indiquer",
        ];
    }
}
