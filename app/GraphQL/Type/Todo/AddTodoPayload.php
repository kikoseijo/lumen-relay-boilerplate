<?php

namespace App\GraphQL\Type\Todo;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\PayloadType as BasePayloadType;
use GraphQL;

class AddTodoPayload extends BasePayloadType
{
    protected $attributes = [
        'name' => 'AddTodoPayload',
    ];

    protected function fields()
    {
        return [
            'todoEdge' => [
                'type' => GraphQL::type('TodoEdge')
            ],
            'viewer' => [
                'type' => GraphQL::type('User')
            ],
            'clientMutationId' => [
                'type' => Type::string()
            ],
        ];
    }
}
