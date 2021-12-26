<?php
declare(strict_types=1);

namespace Framework\LiquidOrm\DataMapper;


use Throwable;

/**
 * @DataMapperInterface
 *
 * @package Framework\LiquidOrm\DataMapper
*/
interface DataMapperInterface
{

       /**
        * Prepare the query string
        *
        * @param string $sqlQuery
        * @return self
       */
       public function prepare(string $sqlQuery): self;




       /**
        * Explicit data type for the parameter using the PDO::PARAM_* constants
        *
        * @param $value
        * @return mixed
       */
       public function bind($value);




       /**
        * Combination method which combines both methods above. One of which is
        * optimized for binding search queries. Once the second argument $type
        * is set to search
        *
        * @param array $fields
        * @param bool $isSearch
        * @return self
       */
       public function bindParameters(array $fields, bool $isSearch = false): self;





       /**
         * returns the number of rows affected by a DELETE, INSERT, or UPDATE statement.
         *
         * @return int|null
       */
       public function numRows(): int;




       /**
         * Execute function which will execute the prepared statement
         *
         * @return void
       */
       public function execute(): void;




       /**
         * Returns a single database row as an object
         *
         * @return object
       */
       public function result(): object;




       /**
        * Returns all the rows within the database as an array
        *
        * @return array
       */
       public function results(): array;



       /**
        * Returns the last inserted row ID from database table
        *
        * @return int
        * @throws Throwable
       */
       public function getLastId(): int;
}