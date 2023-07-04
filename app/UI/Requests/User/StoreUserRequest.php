<?php

namespace App\UI\Requests\User;

use App\Domain\User\StoreUserRequest as StoreUserContract;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest implements StoreUserContract
{
    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
        ];
    }

    public function getName(): string
    {
        return (string) $this->get('name');
    }

    public function getEmail(): string
    {
        return (string) $this->get('email');
    }
}
