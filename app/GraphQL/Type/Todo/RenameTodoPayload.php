<?php

namespace App\GraphQL\Type\Todo;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\PayloadType as BasePayloadType;
use GraphQL;

class RenameTodoPayload extends BasePayloadType
{
    protected $attributes = [
        'name' => 'RenameTodoPayload',
    ];

    protected function fields()
    {
        return [
            'todo' => [
                'type' => GraphQL::type('Todo')
            ],
            'clientMutationId' => [
                'type' => Type::string()
            ],
        ];
    }
}
