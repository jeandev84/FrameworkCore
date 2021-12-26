<?php
declare(strict_types=1);

namespace Framework\LiquidOrm\QueryBuilder;


use Framework\LiquidOrm\QueryBuilder\Exception\QueryBuilderException;


/**
 * @QueryBuilderFactory
 *
 * @package Framework\LiquidOrm\QueryBuilder
*/
class QueryBuilderFactory
{

     /**
      * Main constructor method
      *
      * @return void
     */
     public function __construct()
     {
     }


     /**
      * @param string $queryBuilderString
      * @return QueryBuilderInterface
      * @throws QueryBuilderException
     */
     public function create(string $queryBuilderString): QueryBuilderInterface
     {
          $queryBuilderObject = new $queryBuilderString();

          if (! $queryBuilderObject instanceof QueryBuilderInterface) {
              throw new QueryBuilderException($queryBuilderString .' is not a valid Query builder object.');
          }

          return new QueryBuilder();
     }
}