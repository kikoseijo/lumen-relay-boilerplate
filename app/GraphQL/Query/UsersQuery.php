<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use App\User;

class UsersQuery extends Query
{
    protected $attributes = [
        'name' => 'allUsers',
    ];

    protected function type()
    {
        return Type::listOf(GraphQL::type('User'));
    }

    protected function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'email' => ['name' => 'email', 'type' => Type::string()]

        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {

        $fields = $info->getFieldSelection($depth = 3);

        $query = User::query();

        if (isset($args['id'])) {
            $query->where('id' , $args['id']);
        } else if(isset($args['email'])) {
            $query->where('email', $args['email']);
        }

        foreach ($fields as $field => $keys) {
            if ($field === 'photos') {
                $query->with('photos');
            }

            if ($field === 'todos') {
                $query->with('todos');
            }
        }

        return $query->get();



    }
}
