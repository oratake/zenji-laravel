<?php

namespace App\Http\Requests;

use App\Models\Danka;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DankaUpdateRequest extends FormRequest
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
            'family_head_last_name' => ['required', 'string', 'max:255'],
            'family_head_first_name' => ['required', 'string', 'max:255'],
            'family_head_last_name_kana' => ['required', 'string', 'max:255'],
            'family_head_first_name_kana' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'confirmed', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Danka::class],
            'postcode' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:255'],
            'note' => ['nullable', 'string'],
        ];
    }
}
