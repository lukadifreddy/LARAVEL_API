<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class OperationEditorRequest extends FormRequest
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
            "montant.float"=>"Le montant inserer n'est pas recommandée ex:0.1,200.1",
            "devise.string"=>"Le contenus de ce champ n'est pas une chaine de caractere",
            "devise.max"=>"Les contenus inserer depasse la limitation recommandée",
            "commission.float"=>"La commission inserer n'est pas recommandée ex:0.1,200.1",
            "code_operation.string"=>"Le contenus de ce champ n'est pas une chaine de caractere",
            "code_operation.max"=>"Les contenus inserer depasse la limitation recommandée",
            "code_operation.unique"=>"Le code de l'operation existe déjà",
            "etat.string"=>"Le contenus de ce champ n'est pas une chaine de caractere",
            "etat.max"=>"Les contenus inserer depasse la limitation recommandée",
            "date_livraison.datetime"=>"La date de la livraison n'est pas indiquer",
        ];
    }
}
