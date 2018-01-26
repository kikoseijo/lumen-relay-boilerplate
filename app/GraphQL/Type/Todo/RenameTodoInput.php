<?php

namespace App\GraphQL\Type\Todo;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\InputType as BaseInputType;
use GraphQL;

class RenameTodoInput extends BaseInputType
{
    protected $attributes = [
        'name' => 'RenameTodoInput',
    ];

    protected function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id())
            ],
            'text' => [
                'type' => Type::nonNull(Type::string())
            ],
            'clientMutationId' => [
                'type' => Type::string()
            ],
        ];
    }
}
