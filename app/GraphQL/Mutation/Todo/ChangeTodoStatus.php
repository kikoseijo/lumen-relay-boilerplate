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
        $record = Todo::find($args['input']['id']);
        // logi($record);

        if (!$record) {
            return null;
        }

        // $record->text = $args['input']['text'];
        $record->complete = $args['input']['complete'] ?? 0;
        $record->save();
        return [
            'todo' => $record,
            'viewer' => User::find($context->id)
        ];
    }
}
