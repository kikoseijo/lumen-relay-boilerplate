<?php

namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Folklore\GraphQL\Relay\Support\Mutation as BaseMutation;
use GraphQL;
use App\User;
use Carbon\Carbon;

class Login extends BaseMutation
{
    protected $attributes = [
        'name' => 'login',
    ];

    protected function inputType()
    {
        return GraphQL::type('LoginInput');
    }

    protected function type()
    {
        return GraphQL::type('LoginPayload');
    }

    public function args()
    {
        return [
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'email']
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
      {
          $user = User::where('email', $args['email'])->first();

          if ($user && app('hash')->check($args['password'], $user->password)) {
              $this->deleteExpiredTokens($user);
              $user['token'] = $user->createToken('Todo App')->accessToken;
              return $user;
          }
          throw new AuthorizationException('Error login');
          return null;
      }

      protected function deleteExpiredTokens($user)
      {
          $user->tokens()->where('expires_at', '<=', Carbon::now())->delete();
      }
}
