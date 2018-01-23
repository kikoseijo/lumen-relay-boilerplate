<?php

namespace App\GraphQL\Field;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Folklore\GraphQL\Relay\Support\ConnectionField;
use GraphQL;

class PhotosConnectionField extends ConnectionField
{
    protected $attributes = [
        'name' => 'PhotosConnectionField',
        'description' => 'A field'
    ];

    protected function type()
    {
        return GraphQL::type('PhotosConnection');
    }

    protected function args()
    {
        return [
            'size' => [
                'name' => 'size',
                'type' => Type::string()
            ],
            // 'name' => [
            //     'name' => 'name',
            //     'type' => Type::string()
            // ],
        ];
    }

    public function resolve($root, $args)
    {
        return $root->photos();
    }
}
