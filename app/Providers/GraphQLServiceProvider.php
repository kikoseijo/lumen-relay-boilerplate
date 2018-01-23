<?php

namespace App\Providers;

use GraphQL;
// use GraphQL\GraphQL;
use Illuminate\Support\ServiceProvider;

class GraphQLServiceProvider extends ServiceProvider
{
    /**
     *
     * @return void
     */
    public function register()
    {

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
            'query' => [
                'node' => \Folklore\GraphQL\Relay\NodeQuery::class
            ],
            'mutation' => [
                'updateUserEmail' => 'App\GraphQL\Mutation\UpdateUserEmailMutation',
                // 'updateUser'         => 'App\GraphQL\Mutation\UpdateUserMutation',
                // 'newUser'            => 'App\GraphQL\Mutation\MewUserMutation',
                // 'updateUserEmail'    => 'App\GraphQL\Mutation\UpdateUserEmailMutation',
            ],
        ]);
    }

    private function addTypes()
    {

        GraphQL::addType('\Folklore\GraphQL\Relay\NodeInterface', 'Node');
        GraphQL::addType('\Folklore\GraphQL\Relay\PageInfoType', 'PageInfo');

        GraphQL::addType('App\GraphQL\Type\UserNodeType', 'User');
        GraphQL::addType('App\GraphQL\Type\UpdateUserEmailInput', 'UpdateUserEmailInput');
        GraphQL::addType('App\GraphQL\Type\UpdateUserEmailPayload', 'UpdateUserEmailPayload');

        GraphQL::addType('App\GraphQL\Type\PhotoNodeType', 'Photo');
        GraphQL::addType('App\GraphQL\Type\PhotosConnection', 'PhotosConnection');
    }
}
