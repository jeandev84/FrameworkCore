<?php
declare(strict_types=1);

namespace Framework\LiquidOrm\EntityManager;


use Framework\LiquidOrm\EntityManager\Exception\CrudException;
use Framework\LiquidOrm\DataMapper\DataMapperInterface;
use Framework\LiquidOrm\QueryBuilder\QueryBuilderInterface;


/**
 * @EntityManagerFactory
 *
 * @package Framework\LiquidOrm\EntityManager
*/
class EntityManagerFactory
{

     /**
      * @var DataMapperInterface
     */
     protected DataMapperInterface $dataMapper;


     /**
      * @var QueryBuilderInterface
     */
     protected QueryBuilderInterface $queryBuilder;



     /**
      * Main constructor
      *
      * @param DataMapperInterface $dataMapper
      * @param QueryBuilderInterface $queryBuilder
      *
      * @return void
     */
     public function __construct(DataMapperInterface $dataMapper, QueryBuilderInterface $queryBuilder)
     {
         $this->dataMapper = $dataMapper;
         $this->queryBuilder = $queryBuilder;
     }


    /**
     * @param string $crudString
     * @param string $tableSchema
     * @param string $tableSchemaID
     * @param array $options
     * @return EntityManagerInterface
     * @throws CrudException
     */
     public function create(string $crudString, string $tableSchema, string $tableSchemaID, array $options = []): EntityManagerInterface
     {
          $crudObject = new $crudString($this->dataMapper, $this->queryBuilder, $tableSchema, $tableSchemaID, $options);

          if (! $crudObject instanceof CrudInterface) {
              throw new CrudException($crudString .' is not a valid crud object.');
          }

          return new EntityManager($crudObject);
     }
}