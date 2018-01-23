<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\NodeType as BaseNodeType;
use GraphQL;
use App\Photo;

use App\User;
use App\GraphQL\Field\PhotosConnectionField;

class UserNodeType extends BaseNodeType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A relay node type'
    ];

    protected function fields()
    {
        return [
            'id'    => [
                'type'        => Type::nonNull(Type::id()),
                'description' => 'The id of the user',
            ],
            'name' => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'The name of user',
            ],
            'email' => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'The email of user',
            ],
            'password' => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'The password of the user',
            ],
            'admin' => [
                'type'        => Type::boolean(),
                'description' => 'User level access',
            ],
            // 'photos' => PhotosConnectionField::class
        ];
    }

    public function resolveById($id)
    {
        return User::find($id);
    }
}
