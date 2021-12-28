<?php
declare(strict_types=1);

namespace Framework\LiquidOrm\DataMapper;


use Framework\Database\DatabaseConnection;
use Framework\Database\DatabaseConnectionInterface;
use Framework\LiquidOrm\DataMapper\Exception\DataMapperException;

/**
 * @DataMapperFactory
 *
 * @package Framework\LiquidOrm\DataMapper
*/
class DataMapperFactory
{

     /**
      * Main constructor class
     */
     public function __construct()
     {
     }


    /**
     * @throws DataMapperException
     */
    public function create(string $databaseConnectionString, string $dataMapperEnvironmentConfiguration): DataMapperInterface
     {
          $credentials = (new $dataMapperEnvironmentConfiguration([]))->getDatabaseCredentials('mysql');

          $databaseConnectionObject = new $databaseConnectionString($credentials);

          if (! $databaseConnectionObject instanceof DatabaseConnectionInterface) {
               throw new DataMapperException($databaseConnectionString .' is not a valid database connection object.');
          }

          return new DataMapper($databaseConnectionObject);
     }
}