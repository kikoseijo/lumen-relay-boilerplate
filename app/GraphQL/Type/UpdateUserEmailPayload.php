<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\PayloadType as BasePayloadType;
use GraphQL;

class UpdateUserEmailPayload extends BasePayloadType
{
    protected $attributes = [
        'name' => 'UpdateUserEmailPayload',
        'description' => 'A relay mutation payload type'
    ];

    protected function fields()
    {
        return [
            'user' => [
                'type' => GraphQL::type('User'),
                'description' => 'The user type'
            ]
        ];
    }
}
