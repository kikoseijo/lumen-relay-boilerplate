<?php

namespace App\GraphQL\Query;

use App\User;
use Folklore\GraphQL\Support\Query as BaseQuery;
use GraphQL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class ViewerQuery extends BaseQuery
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'viewer',
        'description' => 'Get the current logged in user',
    ];

    protected function type()
    {
        return GraphQL::type('User');
    }

    // protected function args()
    // {
    //     return [
    //
    //     ];
    // }

    /**
     * @param $root
     * @param $args
     * @param $context
     * @param ResolveInfo $info
     */
    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        if(!$context || !$context->id){
            throw new AuthorizationException('Unauthorized');
            return null;
        }

        return $context;
    }
}
