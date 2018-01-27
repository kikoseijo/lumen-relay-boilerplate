<?php

namespace App\Providers;

use GraphQL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

use App\GraphQL\Query;
use App\GraphQL\Type\Auth;
use App\GraphQL\Type\Todo;

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
        // pass true for production debug otherwise only local will.
        $this->printQueryLogs(false);
        // Create schema\s
        $schema = $this->addSchemas();
        // Add types
        $this->addAuthTypes();
        $this->addTodoTypes();
    }

    private function addSchemas()
    {
        return GraphQL::addSchema('admin', [
            'query'    => [
                'users'  => Query\UsersQuery::class,
                'viewer' => Query\ViewerQuery::class,
            ],
            'mutation' => [
                'App\GraphQL\Mutation\Auth\Login',
                'App\GraphQL\Mutation\Auth\SignupUser',
                'App\GraphQL\Mutation\Auth\UpdateUserEmail',

                'App\GraphQL\Mutation\Todo\AddTodo',
                'App\GraphQL\Mutation\Todo\ChangeTodoStatus',
                'App\GraphQL\Mutation\Todo\MarkAllTodos',
                'App\GraphQL\Mutation\Todo\RemoveCompletedTodos',
                'App\GraphQL\Mutation\Todo\RemoveTodo',
                'App\GraphQL\Mutation\Todo\RenameTodo',
            ],
        ]);
    }

    private function addAuthTypes()
    {

        // GraphQL::addType('\Folklore\GraphQL\Relay\NodeInterface', 'Node');
        // GraphQL::addType('\Folklore\GraphQL\Relay\PageInfoType', 'PageInfo');

        GraphQL::addType(Auth\UserNodeType::class, 'User');
        GraphQL::addType(Auth\UpdateUserEmailInput::class, 'UpdateUserEmailInput');
        GraphQL::addType(Auth\UpdateUserEmailPayload::class, 'UpdateUserEmailPayload');

        GraphQL::addType(Auth\RegisterInput::class, 'RegisterInput');
        GraphQL::addType(Auth\RegisterPayload::class, 'RegisterPayload');

        GraphQL::addType(Auth\LoginInput::class, 'LoginInput');
        GraphQL::addType(Auth\LoginPayload::class, 'LoginPayload');
        // this 2 examples are not fully implemented-,
        GraphQL::addType(\App\GraphQL\Type\PhotoNodeType::class, 'Photo');
        GraphQL::addType(\App\GraphQL\Type\PhotosConnection::class, 'PhotosConnection');
    }

    private function addTodoTypes()
    {
        GraphQL::addType(Todo\TodoNodeType::class, 'Todo');
        GraphQL::addType(Todo\TodoConnection::class, 'TodoConnection');

        GraphQL::addType(Todo\AddTodoInput::class, 'AddTodoInput');
        GraphQL::addType(Todo\AddTodoPayload::class, 'AddTodoPayload');

        GraphQL::addType(Todo\ChangeTodoStatusInput::class, 'ChangeTodoStatusInput');
        GraphQL::addType(Todo\ChangeTodoStatusPayload::class, 'ChangeTodoStatusPayload');

        GraphQL::addType(Todo\MarkAllTodosInput::class, 'MarkAllTodosInput');
        GraphQL::addType(Todo\MarkAllTodosPayload::class, 'MarkAllTodosPayload');

        GraphQL::addType(Todo\RemoveCompletedTodosInput::class, 'RemoveCompletedTodosInput');
        GraphQL::addType(Todo\RemoveCompletedTodosPayload::class, 'RemoveCompletedTodosPayload');

        GraphQL::addType(Todo\RemoveTodoInput::class, 'RemoveTodoInput');
        GraphQL::addType(Todo\RemoveTodoPayload::class, 'RemoveTodoPayload');

        GraphQL::addType(Todo\RenameTodoInput::class, 'RenameTodoInput');
        GraphQL::addType(Todo\RenameTodoPayload::class, 'RenameTodoPayload');
    }

    private function printQueryLogs($allways = false){
        if ($allways || app()->environment() == 'local'){
            DB::listen(function ($sql) {
                logi($sql->sql);
            });
        }
    }
}
