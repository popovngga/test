<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\DTO\CreateUserDto;
use Illuminate\Foundation\Http\FormRequest;

final class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            'phone' => [
                'required',
                'string',
                'phone:lenient'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.phone' => 'The :attribute number is not valid.',
        ];
    }

    public function getDto(): CreateUserDto
    {
        return new CreateUserDto(...$this->validated());
    }
}
