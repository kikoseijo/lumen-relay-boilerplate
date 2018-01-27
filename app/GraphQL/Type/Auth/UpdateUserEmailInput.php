<?php

namespace App\GraphQL\Type\Auth;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\InputType as BaseInputType;
use GraphQL;

class UpdateUserEmailInput extends BaseInputType
{
    protected $attributes = [
        'name' => 'UpdateUserEmailInput',
    ];

    protected function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }
}
