<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class LowonganRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            'category' => 'required',
            'desc' => 'required',
        ];
    }

    public function message(): array
    {
        return [
            'title.required' => 'Masukan Title',
            'location.required' => 'Masukan Lokasi',
            'category.required' => 'Masukan Kategory',
            'desc.required' => 'Masukan Deskripsi',
        ];
    }
}
