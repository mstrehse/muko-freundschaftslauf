<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SponsorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function attributes(){

        return [
            'name' => 'Name des Teams',
            'contact' => 'Ansprechpartner',
            'firstname' => 'Vorname',
            'lastname' => 'Nachname',
            'gender' => 'Anrede',
            'street' => 'Straße Nr.',
            'city' => 'PLZ Ort',
            'country' => 'Land',
            'phone' => 'Telefonnummer',
            'yearofbirth' => 'Geburtsjahr',
            'infos' => 'weitere Informationen'
        ];
    
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'team_id' => 'required|max:255',
            'name' => 'required|max:255',
            'contact' => 'max:255',
            'street' => 'required|max:255',
            'city' => 'required|max:255',
            'email' => 'required|max:255|email',
            'phone' => 'max:255',
            'amount' => 'integer',
            'infos' => 'max:255',
        ];
    }
}
