<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Relay\Support\NodeType as BaseNodeType;
use GraphQL;

class AzBlankNodeType extends BaseNodeType
{
    protected $attributes = [
        'name' => 'AzBlankNodeType',
        'description' => 'A relay node type'
    ];

    protected function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string())
            ],
            // The `connectionField` instantiate the \Folklore\GraphQL\Relay\Support\ConnectionField
            // class which includes the pagination arguments.
            'photos' => Relay::connectionField([
                'type' => GraphQL::type('PhotosConnection'),
                'description' => 'The photos of the user',
                'resolve' => function ($root, $args) {
                    // Here you can use the $args to return the items you want
                    // according to the connection pagination.
                }
            ]),

            // You can also declare a field directly with the edge type without
            // the need to create a connection type using the method `connectionFieldFromEdgeType`
            'photos' => Relay::connectionFieldFromEdgeType(GraphQL::type('Photo'), [
                'description' => 'The photos of the user',
                'resolve' => function ($root, $args) {
                    // Here you can use the $args to return the items you want
                    // according to the connection pagination.
                }
            ]),

            // And finally, if you are using eloquent, you can use
            // the `connectionFieldFromEdgeTypeAndQueryBuilder` method to create
            // a field from an edge type and returning a query builder for you edges.
            'photos' => Relay::connectionFieldFromEdgeTypeAndQueryBuilder(
                GraphQL::type('Photo'),
                function ($root, $args) {
                    return $root->photos();
                    // or
                    return Photo::query()->where('user_id', $root->id);
                },
                [
                    'description' => 'The photos of the user'
                ]
            )
        ];
    }

    public function resolveById($id)
    {
        // Get a node from an id
    }
}
