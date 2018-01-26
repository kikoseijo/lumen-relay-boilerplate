<?php

namespace App\GraphQL\Mutation\Todo;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Folklore\GraphQL\Relay\Support\Mutation as BaseMutation;
use GraphQL;
use App\Todo;

class AddTodo extends BaseMutation
{
    public function __construct(){
        // $this->middleware('auth:api');
    }

    protected $attributes = [
        'name' => 'addTodo',
    ];

    protected function inputType()
    {
        return GraphQL::type('AddTodoInput');
    }

    protected function type()
    {
        return GraphQL::type('AddTodoPayload');
    }

    public function args()
    {
        return [
            'input' => [
                'type' => Type::nonNull(GraphQL::type('AddTodoInput')),
            ]
        ];
    }


    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        logi($args);
        logi($context);
        $record = Todo::create([
            'text' => array_get($args, 'input.text'),
            'complete' => array_get($args, 'input.complete') ?? 0,
            'user_id' => $contex->id
        ]);
        logi($record);
        return $record;
    }
}
