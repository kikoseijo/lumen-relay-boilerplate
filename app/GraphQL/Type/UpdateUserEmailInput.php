<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\InputType as BaseInputType;
use GraphQL;

class UpdateUserEmailInput extends BaseInputType
{
    protected $attributes = [
        'name' => 'UpdateUserEmailInput',
        'description' => 'A relay mutation input type'
    ];

    protected function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id field'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email field'
            ],
        ];
    }
}
