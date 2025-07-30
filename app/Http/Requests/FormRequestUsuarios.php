<?php
 
namespace App\Http\Requests;
 
use Illuminate\Foundation\Http\FormRequest;
 
class FormRequestUsuarios extends FormRequest
{
 
    public function authorize(): bool
    {
        return true;
    }
 
    public function rules(): array
    {
 
        //Inicializa o array de regras
        $request = [];
 
        // Verifica se o método é POST ou PUT
 
        if ($this->method() == 'POST' || $this->method() == 'PUT'){
            $request = [
            'nome' => 'required|string|max:255',
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'password' => 'required',
            ];
        }
 
        //Retorna o array das regras (seja vazio ou com regras)
        return $request;
 
    }
}