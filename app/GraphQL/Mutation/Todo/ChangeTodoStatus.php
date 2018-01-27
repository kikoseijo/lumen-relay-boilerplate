<?php

namespace App\GraphQL\Mutation\Todo;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Folklore\GraphQL\Relay\Support\Mutation as BaseMutation;
use GraphQL;
use App\Todo;
use App\User;

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
        // retrieve real record ID, due to being hidden behind input.
        $relayID = array_get($args,'input.id');
        $globalID = app('graphql.relay')->fromGlobalId($relayID);
        $dbRecordID = array_get($globalID, 'id');

        $record = Todo::findOrFail($dbRecordID);
        $record->complete = array_get($args,'input.complete');
        $record->save();

        // we dont need to call again user to update the info.
        // $viewer = User::findOrFail($context->id);

        return [
            'todo' => $record,
            'viewer' => $context
        ];
    }
}


/**
 * Expected server response from APP client
 *
 *{
 *"data": {
 *  "changeTodoStatus": {
 *    "todo": {
 *      "id": "VG9kbzo2",
 *      "complete": true
 *    },
 *    "viewer": {
 *      "id": "VXNlcjptZQ==",
 *      "completedCount": 3
 *    }
 *  }
 * }
 *}
 *
 *
 *
 *
 *
 *
 *
 *
 */
