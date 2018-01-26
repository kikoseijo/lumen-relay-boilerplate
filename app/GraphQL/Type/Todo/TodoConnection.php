<?php

namespace App\GraphQL\Type\Todo;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\ConnectionType as BaseConnectionType;
use GraphQL;

class TodoConnection extends BaseConnectionType
{
    protected $attributes = [
        'name' => 'TodoConnection',
    ];

    protected function edgeType()
    {
        return GraphQL::type('Todo');
    }
}
