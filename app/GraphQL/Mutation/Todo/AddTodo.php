<?php

namespace App\GraphQL\Mutation\Todo;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Folklore\GraphQL\Relay\Support\Mutation as BaseMutation;
use GraphQL;
use App\Todo;
use App\User;

class AddTodo extends BaseMutation
{

    // protected $inputObject = true;
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

        // $user = User::findOrFail($context->id);

        $record = new Todo();
        $record->text =  array_get($args, 'input.text');
        $record->complete =  array_get($args, 'input.complete')?? 0;
        $record->user_id =  $context->id;
        $record->save();

        // $record = Todo::create([
        //     'text' => array_get($args, 'input.text'),
        //     'complete' => array_get($args, 'input.complete') ?? 0,
        //     'user_id' => $context->id
        // ]);

        return [
          'todoEdge' => [
              'cursor' => $record->id,
              'node' => $record
          ],
          'viewer' => $context,
        ];

    }
}
