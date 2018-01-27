<?php

namespace App\GraphQL\Mutation\Auth;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use App\User;

class UpdateUserPassword extends Mutation
{
    protected $attributes = [
        'name' => 'updateUserPassword',
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::string())],
            'password' => ['name' => 'password', 'type' => Type::nonNull(Type::string())]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $user = User::find($args['id']);

        if (!$user) {
            return null;
        }

        $user->password = $args['password'];
        $user->save();

        return $user;
    }
}
