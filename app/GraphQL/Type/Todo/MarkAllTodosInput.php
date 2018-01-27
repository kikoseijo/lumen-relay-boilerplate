<?php

namespace App\GraphQL\Type\Todo;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\InputType as BaseInputType;
use GraphQL;

class MarkAllTodosInput extends BaseInputType
{
    protected $attributes = [
        'name' => 'MarkAllTodosInput',
    ];

    protected function fields()
    {
        return [
            'complete' => [
                'type' => Type::nonNull(Type::boolean())
            ],
            // 'clientMutationId' => [
            //     'type' => Type::nonNull(Type::string()),
            // ],
        ];
    }
}
