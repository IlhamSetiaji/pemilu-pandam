<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParlemenRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $data = [
            'name' => 'required',
            'visi' => 'required|min:60',
            'misi' => 'required|min:60',
            'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ];

        if(request('_method') == 'PUT'){
            $data['photo'] = 'sometimes|image|mimes:jpg,png,jpeg,gif,svg|max:2048';
        }

        return $data;
    }
}
