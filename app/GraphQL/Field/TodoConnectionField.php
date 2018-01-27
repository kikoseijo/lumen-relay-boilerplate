<?php

namespace App\GraphQL\Field;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Folklore\GraphQL\Relay\Support\ConnectionField;
use GraphQL;
use App\Todo;

class TodoConnectionField extends ConnectionField
{
    protected $attributes = [
        'name' => 'TodoConnectionField',
        'description' => 'A field'
    ];

    protected function type()
    {
        return GraphQL::type('TodoConnection');
    }

    protected function args()
    {
        return [
            'status' => [
                'type' => Type::string()
            ],
            'after' => [
                'type' => Type::string()
            ],
            'first' => [
                'type' => Type::int()
            ],
            'before' => [
                'type' => Type::string()
            ],
            'last' => [
                'type' => Type::int()
            ],
        ];
        // return Type::listOf(GraphQL::type('Todo'));
    }

    public function resolveQueryBuilder($root, $args)
    {
        // $skip = array_get($args, 'after') ?? 0;
        // $first = array_get($args, 'first') ?? 10;
        // $status = array_get($args, 'status') == 'complete' ? 1 : 0;
        return $root->todos();
                    // ->where('complete', $status)
                    // ->skip($skip)
                    // ->take($first);
    }
}
