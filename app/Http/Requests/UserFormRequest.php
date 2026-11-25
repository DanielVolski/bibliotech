<?php

namespace App\Http\Requests;

use App\Rules\CpfValidationRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'unique', 'email'],
            'password' => ['required', 'string', 'min:8'],
            'cpf' => ['required', 'string', 'min:11', "max:13", new CpfValidationRule()],
        ];
    }
}
