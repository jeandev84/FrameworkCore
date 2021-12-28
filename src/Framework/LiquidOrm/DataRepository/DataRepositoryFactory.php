<?php
declare(strict_types=1);

namespace Framework\LiquidOrm\DataRepository;


use Framework\LiquidOrm\DataRepository\Exception\DataRepositoryException;
use Framework\LiquidOrm\DataRepository\Exception\DataRepositoryInvalidArgumentException;

/**
 * @DataRepositoryFactory
*/
class DataRepositoryFactory
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
      * @var string
     */
     protected string $crudIdentifier;



     /**
      * @param string $crudIdentifier
      * @param string $tableSchema
      * @param string $tableSchemaID
     */
     public function __construct(string $crudIdentifier, string $tableSchema, string $tableSchemaID)
     {
         $this->crudIdentifier = $crudIdentifier;
         $this->tableSchema = $tableSchema;
         $this->tableSchemaID = $tableSchemaID;
     }


    /**
     * @param string $dataRepositoryString
     * @return DataRepositoryInterface
     * @throws DataRepositoryException
     */
     public function create(string $dataRepositoryString): DataRepositoryInterface
     {
          $dataRepositoryObject = new $dataRepositoryString();

          if (! $dataRepositoryObject instanceof DataRepositoryInterface) {
               throw new DataRepositoryException($dataRepositoryString .' is not a valid repository object.');
          }

          return $dataRepositoryObject;
     }
}