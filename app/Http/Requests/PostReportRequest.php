<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostReportRequest extends FormRequest
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
            'post_id' => 'Post ID',
            'email' => 'E-Mail Adresse',
            'reason' => 'Löschungsgrund'
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
            'post_id' => 'exists:post,id',
            'reason' => 'required',
            'email' => 'required|email'
        ];
    }
}
