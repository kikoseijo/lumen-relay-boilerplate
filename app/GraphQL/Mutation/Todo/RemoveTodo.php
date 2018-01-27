<?php

namespace App\GraphQL\Mutation\Todo;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Folklore\GraphQL\Relay\Support\Mutation as BaseMutation;
use GraphQL;
use App\Todo;
use App\User;

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
            'id' => [
                'name' => 'input',
                'type' => Type::nonNull(GraphQL::type('RemoveTodoInput')),
            ],

        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        // retrieve ID, due to being hidden behind input.
        $relayID = array_get($args,'input.id');
        $globalId = app('graphql.relay')->fromGlobalId($relayID);
        $id = array_get($globalId,'id');
        // delete record.
        $record = Todo::findOrFail($id);
        $record->delete();

        return [
            'deletedTodoId' => $relayID,
            'viewer' => $context
        ];
    }
}
