<?php

namespace App\GraphQL\Type\Todo;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\InputType;
use GraphQL;

class RemoveTodoInput extends InputType
{
    protected $attributes = [
        'name' => 'RemoveTodoInput',
    ];

    protected function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string())
            ],
            // 'clientMutationId' => [
            //     'type' => Type::nonNull(Type::string()),
            // ],
        ];
    }
}
