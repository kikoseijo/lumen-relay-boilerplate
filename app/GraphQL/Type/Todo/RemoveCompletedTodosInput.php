<?php

namespace App\GraphQL\Type\Todo;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\InputType as BaseInputType;
use GraphQL;

class RemoveCompletedTodosInput extends BaseInputType
{
    protected $attributes = [
        'name' => 'RemoveCompletedTodosInput',
    ];

    protected function fields()
    {
        return [
            // 'clientMutationId' => [
            //     'type' => Type::nonNull(Type::string()),
            // ],
        ];
    }
}
