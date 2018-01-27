<?php

namespace App\GraphQL\Type\Auth;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\InputType as BaseInputType;
use GraphQL;

class RegisterInput extends BaseInputType
{
    protected $attributes = [
        'name' => 'RegisterInput',
    ];

    protected function fields()
    {
      return [
          'name' => [
              'name' => 'name',
              'type' => Type::nonNull(Type::string()),
              'rules' => ['required']
          ],
          'email' => [
              'name' => 'email',
              'type' => Type::nonNull(Type::string()),
              'rules' => ['required', 'email']
          ],
          'password' => [
              'name' => 'id',
              'type' => Type::nonNull(Type::string()),
              'rules' => ['required']
          ]
      ];
    }
}
