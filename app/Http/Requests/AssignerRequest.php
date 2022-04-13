<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignerRequest extends FormRequest
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
            'frequenceD'=>'required|max:255',
            'id_personneV'=>'required|exists:personneVulnerable,id',
            'id_dispositif'=>'required|exists:dispositif,id'
        ];
    }
}
