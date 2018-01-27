<?php

namespace App\GraphQL\Type\Auth;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\PayloadType as BasePayloadType;
use GraphQL;

class UpdateUserEmailPayload extends BasePayloadType
{
    protected $attributes = [
        'name' => 'UpdateUserEmailPayload',
    ];

    protected function fields()
    {
        return [
            'user' => [
                'type' => GraphQL::type('User'),
            ]
        ];
    }
}
