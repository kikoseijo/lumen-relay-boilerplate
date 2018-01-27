<?php

namespace App\GraphQL\Type\Todo;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\PayloadType as BasePayloadType;
use GraphQL;

class MarkAllTodosPayload extends BasePayloadType
{
    protected $attributes = [
        'name' => 'MarkAllTodosPayload',
    ];

    protected function fields()
    {
        return [
            'changedTodos' => [
                'type' => Type::listOf(GraphQL::type('Todo'))
            ],
            'viewer' => [
                'type' => GraphQL::type('User')
            ],
        ];
    }
}
