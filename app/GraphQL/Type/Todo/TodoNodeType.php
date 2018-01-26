<?php

namespace App\GraphQL\Type\Todo;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\NodeType as BaseNodeType;
use GraphQL;
use App\Todo;

class TodoNodeType extends BaseNodeType
{
    protected $attributes = [
        'name' => 'Todo',
    ];

    protected function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id())
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
