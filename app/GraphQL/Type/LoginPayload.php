<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\PayloadType as BasePayloadType;
use GraphQL;

class LoginPayload extends BasePayloadType
{
    protected $attributes = [
        'name' => 'LoginPayload',
    ];

    protected function fields()
    {
        return [
            'user' => [
                'type' => GraphQL::type('User'),
            ],
            'token' => [
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }
}
