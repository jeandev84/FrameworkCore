<?php
declare(strict_types=1);


namespace Framework\LiquidOrm\DataMapper;


use Framework\LiquidOrm\DataMapper\Exception\DataMapperInvalidArgumentException;
use Framework\LiquidOrm\DataMapper\Exception\DataMapperException;


/**
 * @DataMapperEnvironmentConfiguration
 *
 * @package  Framework\LiquidOrm\DataMapper
*/
class DataMapperEnvironmentConfiguration
{

       /**
        * @var array
       */
       private array $credentials = [];


       /**
        * Main construct class
        *
        * @param array $credentials
        * @return void
       */
       public function __construct(array $credentials)
       {
            $this->credentials = $credentials;
       }


       /**
        * Get the user defined database connection array
        *
        * @param string $driver
        * @return array
       */
       public function getDatabaseCredentials(string $driver): array
       {
            $connectionArray = [];

            foreach ($this->credentials as $credentials) {
                if (array_key_exists($driver, $credentials)) {
                    $connectionArray = $credentials[$driver];
                }
            }

            return $connectionArray;
       }


       /**
        * Checks credentials for validity
        *
        * @param string $driver
        * @return void
       */
       private function isCredentialsValid($driver)
       {
            if (empty($driver) && ! is_string($driver)) {
                throw new DataMapperInvalidArgumentException('Invalid argument. This is either missing or off the invalid data type.');
            }

            /*
            if (! is_array($this->credentials)) {
                throw new DataMapperInvalidArgumentException('Invalid credentials.');
            }
            */


            if (! in_array($driver, array_keys($this->credentials[$driver]))) {
                throw new DataMapperInvalidArgumentException('Invalid or unsupported database driver.');
            }
       }
}