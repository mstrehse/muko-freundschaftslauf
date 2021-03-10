<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeamRequest extends FormRequest
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
            'firstname' => 'Vorname',
            'lastname' => 'Nachname',
            'gender' => 'Anrede',
            'street' => 'Straße Nr.',
            'city' => 'PLZ Ort',
            'country' => 'Land',
            'phone' => 'Telefonnummer',
            'yearofbirth' => 'Geburtsjahr'
        ];
    
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $emailRule = Rule::unique('teams');
        if($this->team){
            $emailRule->ignore($this->team->id, 'id');
        }

        return [
            'name' => 'required|max:255',
            'gender' => 'required|max:255',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'street' => 'required|max:255',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'email' => [
                'required',
                'email',
                $emailRule
            ],
            'phone' => 'max:17',
            'yearofbirth' => 'required|integer|min:1900|max:2020',
        ];
    }
}
