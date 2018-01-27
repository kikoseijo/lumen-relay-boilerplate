<?php

namespace App\GraphQL\Mutation\Auth;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\Mutation as BaseMutation;
use GraphQL;

class SignUpUser extends BaseMutation
{
    protected $attributes = [
        'name' => 'signupUser',
    ];

    protected function inputType()
    {
        return GraphQL::type('RegisterInput');
    }

    protected function type()
    {
        return GraphQL::type('RegisterPayload');
    }

    public function args()
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::string(),
                'rules' => ['required']
            ],
            'password' => [
                'name' => 'password',
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

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $user = User::create($args);
        logi($user);
        return $user;
    }
}
