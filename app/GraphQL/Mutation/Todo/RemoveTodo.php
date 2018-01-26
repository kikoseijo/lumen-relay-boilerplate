<?php

namespace App\GraphQL\Mutation\Todo;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Folklore\GraphQL\Relay\Support\Mutation as BaseMutation;
use GraphQL;

class RemoveTodo extends BaseMutation
{
    protected $attributes = [
        'name' => 'removeTodo',
    ];

    protected function inputType()
    {
        return GraphQL::type('RemoveTodoInput');
    }

    protected function type()
    {
        return GraphQL::type('RemoveTodoPayload');
    }

    public function args()
    {
        return [
            'input' => [
                'type' => Type::nonNull(GraphQL::type('RemoveTodoInput')),
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {

    }
}
