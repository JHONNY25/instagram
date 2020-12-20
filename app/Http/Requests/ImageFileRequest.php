<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageFileRequest extends FormRequest
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
        $rules = [
            'image' => 'required|mimes:jpg,png,jpeg|max:2000',
        ];

        if($this->get('posttext')){
            $rules['posttext'] = 'required|max:250';
        }
        
        return $rules;
    }

    public function messages()
    {
        return [
            'image.required' => 'La imagen es requerida',
            '*.mimes' => 'Debe de ser un formato de imagen como jpg,png,jpeg',
            'image.max' => 'La imagen no debe exceder los 2MB',
            'posttext.required' => 'Debe ingresar un texto',
            'posttext.max' => 'La imagen no debe exceder los 2MB',
        ];
    }
}
