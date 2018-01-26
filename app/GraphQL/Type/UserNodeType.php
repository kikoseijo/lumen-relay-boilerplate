<?php

namespace App\GraphQL\Type;

use App\User;
use Folklore\GraphQL\Relay\Support\NodeType;
use Folklore\GraphQL\Relay\Support\Facades\Relay;
use GraphQL;
use App\GraphQL\Field\TodoConnectionField;
use GraphQL\Type\Definition\Type;

class UserNodeType extends NodeType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'User',
    ];

    protected function fields()
    {
        return [
            'id'       => [
                'type'        => Type::nonNull(Type::id()),
            ],
            'name'     => [
                'type'        => Type::nonNull(Type::string()),
            ],
            'email'    => [
                'type'        => Type::nonNull(Type::string()),
            ],
            'token'    => [
                'type'        => Type::string(),
            ],
            'password' => [
                'type'        => Type::nonNull(Type::string()),
            ],
            'admin'    => [
                'type'        => Type::boolean(),
            ],
            'totalCount'    => [
                'type'        => Type::int(),
            ],
            'completedCount'    => [
                'type'        => Type::int(),
            ],
            // 'todos' => Relay::connectionFieldFromEdgeTypeAndQueryBuilder(
            //     GraphQL::type('Todo'),
            //     function ($root, $args) {
            //         return $root->todos();
            //         // or
            //         // return Photo::query()->where('user_id', $root->id);
            //     },
            //     [
            //         'description' => 'The photos of the user'
            //     ]
            // )
            'todos' => TodoConnectionField::class
        ];
    }

    protected function resolveEmailField($root, $args)
	{
		return strtolower("cusro@field-resolver.org");
	}
    protected function resolveCompletedCountField($root, $args)
	{
		return $root->todos()->where('complete',1)->count();
	}
    protected function resolveTotalCountField($root, $args)
	{
		return $root->todos()->count();
	}

    /**
     * @param $id
     */
    public function resolveById($id)
    {
        return User::find($id);
    }
}
