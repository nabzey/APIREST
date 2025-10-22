<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompteRequest extends FormRequest
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
        $compteId = $this->route('compte')?->id ?? $this->route('compte');

        return [
            'type' => 'sometimes|in:courant,epargne,entreprise',
            'statut' => 'sometimes|in:actif,bloque,ferme',
            'solde' => 'sometimes|numeric|min:0',
            'client_id' => 'sometimes|exists:clients,id',
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
            'type.in' => 'Le type de compte doit être courant, épargne ou entreprise.',
            'statut.in' => 'Le statut doit être actif, bloqué ou fermé.',
            'solde.numeric' => 'Le solde doit être un nombre.',
            'solde.min' => 'Le solde ne peut pas être négatif.',
            'client_id.exists' => 'Le client spécifié n\'existe pas.',
        ];
    }
}
