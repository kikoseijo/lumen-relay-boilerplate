<?php

namespace App\GraphQL\Mutation\Todo;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Folklore\GraphQL\Relay\Support\Mutation as BaseMutation;
use GraphQL;
use App\Todo;

class MarkAllTodos extends BaseMutation
{
    protected $attributes = [
        'name' => 'markAllTodos',
    ];

    protected function inputType()
    {
        return GraphQL::type('MarkAllTodosInput');
    }

    protected function type()
    {
        return GraphQL::type('MarkAllTodosPayload');
    }

    public function args()
    {
        return [
            'input' => [
                'type' => Type::nonNull(GraphQL::type('MarkAllTodosInput')),
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $newStatus = array_get($args,'input.complete');

        $records = Todo::where('user_id', '=', $context->id)->get();
        foreach ($records as $record) {
            $record->complete = $newStatus;
            $record->save();
        }

        return [
            'changedTodos' => $records,
            'viewer' => $context
        ];
    }
}
