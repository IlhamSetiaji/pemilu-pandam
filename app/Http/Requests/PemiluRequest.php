<?php

namespace App\Http\Requests;

use App\Models\Pemilu;
use Illuminate\Foundation\Http\FormRequest;

class PemiluRequest extends FormRequest
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
        $method = request('method') ?? $this->method();
        $id = request('pemiluID');
        switch ($method) {
            case 'PUT':
                return [
                    'name' => 'required|string|unique:pemilu,name,' . $id,
                    'start_date' => 'required|date',
                    'end_date' => 'required|date|after:start_date',
                ];
                break;
            case 'POST':
                return [
                    'name' => 'required|string|unique:pemilu,name',
                    'start_date' => 'required|date|after_or_equal:today',
                    'end_date' => 'required|date|after:start_date',
                ];
                break;
            default:
                return [];
                break;
        }
    }
}
