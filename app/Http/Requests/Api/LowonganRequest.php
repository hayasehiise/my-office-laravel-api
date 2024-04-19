<?php

namespace App\Http\Requests\Api;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class LowonganRequest extends FormRequest
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
        // return true;
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
            'location' => 'required',
            'type' => 'required',
            'company' => 'required',
            'category' => 'required',
            'desc' => 'required',
        ];
    }

    public function message(): array
    {
        return [
            'title.required' => 'Masukan Title',
            'location.required' => 'Masukan Lokasi',
            'type.required' => 'Masukan Lokasi',
            'company.required' => 'Masukan Lokasi',
            'category.required' => 'Masukan Kategory',
            'desc.required' => 'Masukan Deskripsi',
        ];
    }
}
