<?php

namespace App\GraphQL\Type\Todo;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\InputType as BaseInputType;
use GraphQL;

class AddTodoInput extends BaseInputType
{
    protected $attributes = [
        'name' => 'AddTodoInput',
    ];

    protected function fields()
    {
        return [
            'text' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ],
            'clientMutationId' => [
                'type' => Type::string(),
                'rules' => ['required']
            ],
        ];
    }
}
