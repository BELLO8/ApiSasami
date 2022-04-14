<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfillingRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'temperatureM'=>'required',
            'nombre_pasM'=>'required',
            'frequence_resM'=>'required',
            'rythme_cardM'=>'required',
            'dates'=>'required',
            'id_assigner'=>'required'
        ];
    }
}
