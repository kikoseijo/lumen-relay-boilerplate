<?php

namespace App\GraphQL\Type\Todo;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\NodeType;
use GraphQL;
use App\Todo;

class TodoNodeType extends NodeType
{
    protected $attributes = [
        'name' => 'Todo',
    ];

    protected function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string())
            ],
            'text' => [
                'type' => Type::string()
            ],
            'complete' => [
                'type' => Type::boolean()
            ],
        ];
    }

    public function resolveById($id)
    {
        return Todo::find($id);
    }
}
