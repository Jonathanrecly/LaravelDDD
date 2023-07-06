<?php

namespace App\Infrastructure\UI\Requests\User;

use App\Domain\User\UpdateUserRequest as UpdateUserContract;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest implements UpdateUserContract
{
    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'name' => ['string'],
            'email' => ['string'],
        ];
    }

    public function getName(): ?string
    {
        return (string) $this->get('name');
    }

    public function getEmail(): ?string
    {
        return (string) $this->get('email');
    }
}
