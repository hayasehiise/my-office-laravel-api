<?php

namespace App\Http\Requests\Api;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class WebinarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $tokenInputPass = Hash::make($this->input('token'));
        if (Hash::check('awaludapi', $tokenInputPass)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'time' => 'required',
            'date' => 'required',
            'via' => 'required',
            'price' => 'required|integer',
            'discount' => 'required|integer',
        ];
    }
}
