<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\PayloadType as BasePayloadType;
use GraphQL;

class RegisterPayload extends BasePayloadType
{
    protected $attributes = [
        'name' => 'RegisterPayload',
    ];

    protected function fields()
    {
        return [
          'token' => [
              'type' => Type::nonNull(Type::string())
          ],
          'id' => [
              'type' => Type::nonNull(Type::string())
          ],
        ];
    }
}
