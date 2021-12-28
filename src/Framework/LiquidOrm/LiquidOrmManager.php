<?php
declare(strict_types=1);

namespace Framework\LiquidOrm;


use Framework\Database\DatabaseConnection;
use Framework\LiquidOrm\DataMapper\DataMapperEnvironmentConfiguration;
use Framework\LiquidOrm\DataMapper\DataMapperFactory;
use Framework\LiquidOrm\EntityManager\Crud;
use Framework\LiquidOrm\EntityManager\EntityManagerFactory;
use Framework\LiquidOrm\EntityManager\Exception\CrudException;
use Framework\LiquidOrm\QueryBuilder\QueryBuilder;
use Framework\LiquidOrm\QueryBuilder\QueryBuilderFactory;
use Framework\LiquidOrm\DataMapper\Exception\DataMapperException;
use Framework\LiquidOrm\QueryBuilder\Exception\QueryBuilderException;



/**
 * @LiquidOrmManager
*/
class LiquidOrmManager
{

      /**
       * @var string
      */
      protected string $tableSchema;



      /**
       * @var string
      */
      protected string $tableSchemaID;




       /**
        * @var DataMapperEnvironmentConfiguration
       */
       protected DataMapperEnvironmentConfiguration $environmentConfiguration;




       /**
        * @var array
       */
       protected array $options;




       /**
        * @param DataMapperEnvironmentConfiguration $environmentConfiguration
        * @param string $tableSchema
        * @param string $tableSchemaID
        * @param array|null $options
       */
       public function __construct(
           DataMapperEnvironmentConfiguration $environmentConfiguration,
           string $tableSchema,
           string $tableSchemaID,
           ?array $options = []
       )
       {
           // pipe (affectation)
           $this->environmentConfiguration = $environmentConfiguration;
           $this->tableSchema = $tableSchema;
           $this->tableSchemaID = $tableSchemaID;
           $this->options = $options;
       }


    /**
     * @throws DataMapperException
     * @throws CrudException|QueryBuilderException
     */
       public function initialize()
       {
           $dataMapperFactory = new DataMapperFactory();
           $dataMapper        = $dataMapperFactory->create(
               DatabaseConnection::class,
      DataMapperEnvironmentConfiguration::class
                               );

           if ($dataMapper) {

                $queryBuilderFactory = new QueryBuilderFactory();
                $queryBuilder = $queryBuilderFactory->create(QueryBuilder::class);

                if ($queryBuilder) {
                    $entityManagerFactory = new EntityManagerFactory($dataMapper, $queryBuilder);

                    return $entityManagerFactory->create(Crud::class, $this->tableSchema, $this->tableSchemaID, $this->options);
                }
           }
       }

}