<?php

namespace App\GraphQL\Mutation\Todo;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Folklore\GraphQL\Relay\Support\Mutation as BaseMutation;
use GraphQL;

class RemoveCompletedTodos extends BaseMutation
{
    protected $attributes = [
        'name' => 'removeCompletedTodos',
    ];

    protected function inputType()
    {
        return GraphQL::type('RemoveCompletedTodosInput');
    }

    protected function type()
    {
        return GraphQL::type('RemoveCompletedTodosPayload');
    }

    public function args()
    {
        return [
            'input' => [
                'type' => Type::nonNull(GraphQL::type('RemoveCompletedTodosInput')),
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {

    }
}
