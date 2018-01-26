<?php

namespace App\GraphQL\Mutation\Todo;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Folklore\GraphQL\Relay\Support\Mutation as BaseMutation;
use GraphQL;

class RenameTodo extends BaseMutation
{
    protected $attributes = [
        'name' => 'renameTodo',
    ];

    protected function inputType()
    {
        return GraphQL::type('RenameTodoInput');
    }

    protected function type()
    {
        return GraphQL::type('RenameTodoPayload');
    }

    public function args()
    {
        return [
            'input' => [
                'type' => Type::nonNull(GraphQL::type('RenameTodoInput')),
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {

    }
}
