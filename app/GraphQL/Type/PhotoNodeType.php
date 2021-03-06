<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\NodeType as BaseNodeType;
use GraphQL;
use App\Photo;

class PhotoNodeType extends BaseNodeType
{
    protected $attributes = [
        'name' => 'Photo',
    ];

    protected function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string())
            ],
            // 'name' => [
            //     'type'        => Type::nonNull(Type::string()),
            //     'description' => 'The url of the file',
            // ],
            // 'size' => [
            //     'type'        => Type::nonNull(Type::string()),
            //     'description' => 'The size of the file',
            // ],
        ];
    }

    public function resolveById($id)
    {
        return Photo::find($id);
    }
}
