<?php

namespace App\Providers;

use App\GraphQL\Query\UsersQuery;
use App\GraphQL\Query\ViewerQuery;
use App\GraphQL\Type\UserNodeType;
use GraphQL;
// use GraphQL\GraphQL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class GraphQLServiceProvider extends ServiceProvider
{

    /**
     * @var mixed
     */
    protected $schema;
    /**
     *
     * @return void
     */
    public function register() {}

    /**
     *
     * @return void
     */
    public function boot()
    {
        // DB::enableQueryLog();
        DB::listen(function ($sql) {
            logi($sql->sql);
        });
        $schema = $this->addSchemas();
        $this->addTypes();
        // Event::listen('illuminate.query', function ($query) {
        //     logi(json_encode($query));
        // });
        // Event::listen('illuminate.query', function ($sql) {
        //     logi(json_encode($sql));
        // });

        // DB::listen(function ($sql, $bindings, $time) {
        //     Log::info(sprintf('%s (%s) : %s', $sql, implode(',', $bindings), $time));
        // });
    }

    private function addSchemas()
    {
        return GraphQL::addSchema('admin', [
            'query'    => [
                'users'  => UsersQuery::class,
                'viewer' => ViewerQuery::class,
            ],
            'mutation' => [
                'App\GraphQL\Mutation\Login',
                'App\GraphQL\Mutation\SignupUser',
                'App\GraphQL\Mutation\UpdateUserEmail',

                'App\GraphQL\Mutation\Todo\AddTodo',
                'App\GraphQL\Mutation\Todo\ChangeTodoStatus',
                'App\GraphQL\Mutation\Todo\MarkAllTodos',
                'App\GraphQL\Mutation\Todo\RemoveCompletedTodos',
                'App\GraphQL\Mutation\Todo\RemoveTodo',
                'App\GraphQL\Mutation\Todo\RenameTodo',
            ],
        ]);
    }

    private function addTypes()
    {

        // GraphQL::addType('\Folklore\GraphQL\Relay\NodeInterface', 'Node');
        // GraphQL::addType('\Folklore\GraphQL\Relay\PageInfoType', 'PageInfo');

        GraphQL::addType(UserNodeType::class, 'User');
        GraphQL::addType('App\GraphQL\Type\UpdateUserEmailInput', 'UpdateUserEmailInput');
        GraphQL::addType('App\GraphQL\Type\UpdateUserEmailPayload', 'UpdateUserEmailPayload');

        GraphQL::addType('App\GraphQL\Type\RegisterInput', 'RegisterInput');
        GraphQL::addType('App\GraphQL\Type\RegisterPayload', 'RegisterPayload');

        GraphQL::addType('App\GraphQL\Type\LoginInput', 'LoginInput');
        GraphQL::addType('App\GraphQL\Type\LoginPayload', 'LoginPayload');

        GraphQL::addType('App\GraphQL\Type\PhotoNodeType', 'Photo');
        GraphQL::addType('App\GraphQL\Type\PhotosConnection', 'PhotosConnection');

        GraphQL::addType('App\GraphQL\Type\Todo\TodoNodeType', 'Todo');
        GraphQL::addType('App\GraphQL\Type\Todo\TodoConnection', 'TodoConnection');
        // // GraphQL::addType('App\GraphQL\Field\TodoConnectionField', 'TodoConnectionField');
        //
        GraphQL::addType('App\GraphQL\Type\Todo\AddTodoInput', 'AddTodoInput');
        GraphQL::addType('App\GraphQL\Type\Todo\AddTodoPayload', 'AddTodoPayload');
        GraphQL::addType('App\GraphQL\Type\Todo\ChangeTodoStatusInput', 'ChangeTodoStatusInput');
        GraphQL::addType('App\GraphQL\Type\Todo\ChangeTodoStatusPayload', 'ChangeTodoStatusPayload');
        GraphQL::addType('App\GraphQL\Type\Todo\MarkAllTodosInput', 'MarkAllTodosInput');
        GraphQL::addType('App\GraphQL\Type\Todo\MarkAllTodosPayload', 'MarkAllTodosPayload');
        GraphQL::addType('App\GraphQL\Type\Todo\RemoveCompletedTodosInput', 'RemoveCompletedTodosInput');
        GraphQL::addType('App\GraphQL\Type\Todo\RemoveCompletedTodosPayload', 'RemoveCompletedTodosPayload');
        GraphQL::addType('App\GraphQL\Type\Todo\RemoveTodoInput', 'RemoveTodoInput');
        GraphQL::addType('App\GraphQL\Type\Todo\RemoveTodoPayload', 'RemoveTodoPayload');
        GraphQL::addType('App\GraphQL\Type\Todo\RenameTodoInput', 'RenameTodoInput');
        GraphQL::addType('App\GraphQL\Type\Todo\RenameTodoPayload', 'RenameTodoPayload');
        // GraphQL::addType('App\GraphQL\Type\Todo\TodoConnection', 'TodoConnection');
        // GraphQL::addType('App\GraphQL\Type\Todo\TodoNodeType', 'TodoNodeType');

    }
}
