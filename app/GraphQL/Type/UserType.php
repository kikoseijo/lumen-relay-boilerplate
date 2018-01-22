<?php namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class UserType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'User',
        'description' => 'A user',
    ];

    /*
     * Uncomment following line to make the type input object.
     * http://graphql.org/learn/schema/#input-types
     */
    // protected $inputObject = true;

    public function fields()
    {
        return [
            'id'    => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'The id of the user',
            ],
            'email' => [
                'type'        => Type::string(),
                'description' => 'The email of user',
            ],
        ];
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    /**
     * @param $root
     * @param $args
     */
    protected function resolveEmailField($root, $args)
    {
        return strtolower($root->email);
    }
}
