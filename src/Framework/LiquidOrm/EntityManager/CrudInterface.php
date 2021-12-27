<?php
declare(strict_types=1);

namespace Framework\LiquidOrm\EntityManager;


/**
 * @CrudInterface
*/
interface CrudInterface
{

    /**
     * Get database table name
     *
     * @return string
    */
    public function getSchema(): string;




    /**
     * Get the name of primary key column of database table
     *
     * @return string
    */
    public function getSchemaID(): string;



    /**
     * Last Id returned query statement
     *
     * @return int
    */
    public function lastID(): int;



    /**
     * Create record to the specific table
     *
     * @param array $fields
     * @return bool
    */
    public function create(array $fields = []): bool;



    /**
     * Select record by given arguments
     *
     * @param array $selectors
     * @param array $conditions
     * @param array $parameters
     * @param array $optional
     * @return array
    */
    public function read(array $selectors = [], array $conditions = [], array $parameters = [], array $optional = []): array;



    /**
     * Update record of table
     *
     * @param array $fields
     * @param string $primaryKey
     * @return bool
    */
    public function update(array $fields = [], string $primaryKey = 'id'): bool;




    /**
     * Delete table record
     *
     * @param array $conditions
     * @return bool
    */
    public function delete(array $conditions = []): bool;




    /**
     * Search functionalities
     *
     * @param array $selectors
     * @param array $conditions
     * @return array
    */
    public function search(array $selectors = [], array $conditions = []): array;




    /**
     * Helper function for execute query
     *
     * @param string $rawQuery
     * @param array $conditions
     * @return mixed
    */
    public function rawQuery(string $rawQuery, array $conditions = []);
}