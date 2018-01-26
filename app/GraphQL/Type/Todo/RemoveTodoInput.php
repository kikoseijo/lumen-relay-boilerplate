<?php

namespace App\GraphQL\Type\Todo;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\InputType as BaseInputType;
use GraphQL;

class RemoveTodoInput extends BaseInputType
{
    protected $attributes = [
        'name' => 'RemoveTodoInput',
    ];

    protected function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id())
            ],
            'clientMutationId' => [
                'type' => Type::string()
            ],
        ];
    }
}
