<?php

namespace App\GraphQL\Type\Todo;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\PayloadType as BasePayloadType;
use GraphQL;

class ChangeTodoStatusPayload extends BasePayloadType
{
    protected $attributes = [
        'name' => 'ChangeTodoStatusPayload',
    ];

    protected function fields()
    {
        return [
            'todo' => [
                'type' => GraphQL::type('Todo')
            ],
            'viewer' => [
                'type' => GraphQL::type('User')
            ],
            // 'clientMutationId' => [
            //     'type' => Type::nonNull(Type::string())
            // ],
        ];
    }
}
