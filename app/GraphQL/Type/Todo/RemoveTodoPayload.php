<?php

namespace App\GraphQL\Type\Todo;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\PayloadType as BasePayloadType;
use GraphQL;

class RemoveTodoPayload extends BasePayloadType
{
    protected $attributes = [
        'name' => 'RemoveTodoPayload',
    ];

    protected function fields()
    {
        return [
            'deletedTodoId' => [
                'type' => Type::id()
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
