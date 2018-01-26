<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use Illuminate\Pagination\LengthAwarePaginator;
use GraphQL;

class PaginationType extends ObjectType
{
  /**
   * PaginationType constructor.
   * @param String $typeName
   */
  public function __construct($typeName)
  {
      parent::__construct([
          'name' => $typeName . 'Pagination',
          'fields' => [
              'data' => [
                  'type' => Type::listOf(\GraphQL::type($typeName)),
                  'resolve' => function (LengthAwarePaginator $data) {
                      return $data->getCollection();
                  },
              ],
              'total' => [
                  'type' => Type::nonNull(Type::int()),
                  'resolve' => function (LengthAwarePaginator $data) {
                      return $data->total();
                  },
                  'selectable' => false,
              ],
              'limit' => [
                  'type' => Type::nonNull(Type::int()),
                  'resolve' => function (LengthAwarePaginator $data) {
                      return $data->perPage();
                  },
                  'selectable' => false,
              ],
              'page' => [
                  'type' => Type::nonNull(Type::int()),
                  'resolve' => function (LengthAwarePaginator $data) {
                      return $data->currentPage();
                  },
                  'selectable' => false,
              ],
          ],
      ]);
  }
}
