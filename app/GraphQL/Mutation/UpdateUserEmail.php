<?php

namespace App\GraphQL\Mutation;

use Folklore\GraphQL\Relay\Support\Mutation as BaseMutation;
use GraphQL\Type\Definition\Type;
use GraphQL;

class UpdateUserEmail extends BaseMutation
{
    protected $attributes = [
        'name' => 'updateUserEmail',
    ];

    protected function inputType()
    {
        return GraphQL::type('UpdateUserEmailInput');
    }

    public function type()
    {
        return GraphQL::type('UpdateUserEmailPayload');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::string(),
                'rules' => ['required']
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
                'rules' => ['required', 'email']
            ]
        ];
    }

    // Alternate validation method.
    // public function rules()
    // {
    //     return [
    //         'id' => ['required'],
    //         'email' => ['required', 'email']
    //     ];
    // }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $user = User::find($args['input']['id']);

        if (!$user) {
            return null;
        }

        $user->email = $args['input']['email'];
        $user->save();

        return [
            'user' => $user
        ];
    }
}
