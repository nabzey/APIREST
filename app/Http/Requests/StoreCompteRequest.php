<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompteRequest extends FormRequest
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
            'type' => 'required|in:courant,epargne,entreprise',
            'statut' => 'sometimes|in:actif,bloque,ferme',
            'solde' => 'required|numeric|min:10000',
            'client_id' => 'required|exists:clients,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'type.required' => 'Le type de compte est obligatoire.',
            'type.in' => 'Le type de compte doit être courant, épargne ou entreprise.',
            'statut.in' => 'Le statut doit être actif, bloqué ou fermé.',
            'solde.required' => 'Le solde est obligatoire.',
            'solde.numeric' => 'Le solde doit être un nombre.',
            'solde.min' => 'Le solde minimum est de 10 000 FCFA.',
            'client_id.required' => 'L\'ID du client est obligatoire.',
            'client_id.exists' => 'Le client spécifié n\'existe pas.',
        ];
    }
}
