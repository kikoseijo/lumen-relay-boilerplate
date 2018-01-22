<?php

namespace App\GraphQL\Mutation;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

class NewUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'NewUser'
    ];
    public function type()
    {
        return GraphQL::type('users');
    }
    public function args()
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string())
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string())
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string())
            ],
            'admin' => [
                'name' => 'admin',
                'type' => Type::bool()
            ]
        ];
    }
    public function resolve($root, $args)
    {
        $user = User::create($args);
        if (!$user) {
            return null;
        }
        // $user->user_profiles()->create($args);
        return $user;
    }
}
