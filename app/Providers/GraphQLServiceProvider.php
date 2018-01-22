<?php

namespace App\Providers;

use GraphQL;
use Illuminate\Support\ServiceProvider;

class GraphQLServiceProvider extends ServiceProvider
{
    /**
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     *
     * @return void
     */
    public function boot()
    {
        $this->addSchemas();
        $this->addTypes();
    }

    private function addSchemas()
    {
        GraphQL::addSchema('admin', [
            'query'    => [
                'users' => 'App\GraphQL\Query\UsersQuery',
            ],
            'mutation' => [
                'updateUserPassword' => 'App\GraphQL\Mutation\UpdateUserPasswordMutation',
                'updateUser'         => 'App\GraphQL\Mutation\UpdateUserMutation',
                'newUser'            => 'App\GraphQL\Mutation\MewUserMutation',
                'updateUserEmail'    => 'App\GraphQL\Mutation\UpdateUserEmailMutation',
            ],
        ]);
    }

    private function addTypes()
    {
        GraphQL::addType('App\GraphQL\Type\UserType', 'User');
    }
}
