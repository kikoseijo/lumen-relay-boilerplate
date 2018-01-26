<?php

namespace App\GraphQL\Type\Todo;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\InputType as BaseInputType;
use GraphQL;

class ChangeTodoStatusInput extends BaseInputType
{
    protected $attributes = [
        'name' => 'ChangeTodoStatusInput',
    ];

    protected function fields()
    {
        return [
            'complete' => [
                'type' => Type::nonNull(Type::boolean())
            ],
            'id' => [
                'type' => Type::nonNull(Type::id())
            ],
            'clientMutationId' => [
                'type' => Type::string()
            ],
        ];
    }
}
