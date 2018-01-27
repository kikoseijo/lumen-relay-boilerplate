<?php

namespace App\GraphQL\Mutation\Todo;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Folklore\GraphQL\Relay\Support\Mutation as BaseMutation;
use GraphQL;
use App\Todo;

class ChangeTodoStatus extends BaseMutation
{
    protected $attributes = [
        'name' => 'changeTodoStatus',
    ];

    protected function inputType()
    {
        return GraphQL::type('ChangeTodoStatusInput');
    }

    protected function type()
    {
        return GraphQL::type('ChangeTodoStatusPayload');
    }

    public function args()
    {
        return [
            'input' => [
                'type' => Type::nonNull(GraphQL::type('ChangeTodoStatusInput')),
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $relayID = array_get($args,'input.id');
        $globalId = app('graphql.relay')->fromGlobalId($relayID);

        $record = Todo::findOrFail(array_get($globalId, 'id'));
        // $record->text = $args['input']['text'];
        $record->complete = array_get($args,'input.complete');
        $record->save();

        $viewer = User::findOrFail($context->id);

        logi($record);
        return [
            'clientMutationId' => $relayID,
            'todo' => $viewer->todos(),
            'viewer' => $viewer
        ];
    }
}
