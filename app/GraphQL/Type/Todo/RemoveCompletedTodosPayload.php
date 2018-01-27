<?php

namespace App\GraphQL\Type\Todo;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\PayloadType as BasePayloadType;
use GraphQL;

class RemoveCompletedTodosPayload extends BasePayloadType
{
    protected $attributes = [
        'name' => 'RemoveCompletedTodosPayload',
    ];

    protected function fields()
    {
        return [
            'deletedTodoIds' => [
                'type' => Type::listOf(GraphQL::type('Todo'))
            ],
            'viewer' => [
                'type' => GraphQL::type('User')
            ],
            // 'clientMutationId' => [
            //     'type' => Type::nonNull(Type::string()),
            // ],
        ];
    }
}
