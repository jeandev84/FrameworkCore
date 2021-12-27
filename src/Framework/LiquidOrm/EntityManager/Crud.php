<?php
declare(strict_types=1);

namespace Framework\LiquidOrm\EntityManager;

use Framework\LiquidOrm\DataMapper\DataMapper;
use Framework\LiquidOrm\QueryBuilder\QueryBuilder;
use Throwable;

/**
 * @Crud
*/
class Crud implements CrudInterface
{

    /**
     * @var DataMapper
    */
    protected DataMapper $dataMapper;


    /**
     * @var QueryBuilder
    */
    protected QueryBuilder $queryBuilder;


    /**
     * @var string
    */
    protected string $tableSchema;


    /**
     * @var string
    */
    protected string $tableSchemaID;


    /**
     * @param DataMapper $dataMapper
     * @param QueryBuilder $queryBuilder
     * @param string $tableSchema
     * @param string $tableSchemaID
    */
    public function __construct(DataMapper $dataMapper, QueryBuilder $queryBuilder, string $tableSchema, string $tableSchemaID)
    {
        $this->dataMapper    = $dataMapper;
        $this->queryBuilder  = $queryBuilder;
        $this->tableSchema   = $tableSchema;
        $this->tableSchemaID = $tableSchemaID;
    }




    /**
     * @inheritDoc
    */
    public function getSchema(): string
    {
        return $this->tableSchema;
    }




    /**
     * @inheritDoc
    */
    public function getSchemaID(): string
    {
        return $this->tableSchemaID;
    }


    /**
     * @inheritDoc
     * @throws Throwable
    */
    public function lastID(): int
    {
        return $this->dataMapper->getLastId();
    }




    /**
     * @inheritDoc
     */
    public function create(array $fields = []): bool
    {
        try {

            $args = ['table' => $this->getSchema(), 'type' => 'insert', 'fields' => $fields];

            $query = $this->queryBuilder->buildQuery($args)->insertQuery();

            /* $this->dataMapper->persist($query, $this->dataMapper->buildQueryParameters($fields)); */
            $this->dataMapper->persist($query, $fields);

            if ($this->dataMapper->numRows() == 1) {
                return true;
            }

            return false;

        } catch (Throwable $e) {

             throw $e;
        }
    }




    /**
     * @inheritDoc
     */
    public function read(array $selectors = [], array $conditions = [], array $parameters = [], array $optional = []): array
    {
        try {

            $args = [
                'table' => $this->getSchema(),
                'type'  => 'select',
                'selectors' => $selectors,
                'conditions' => $conditions,
                'params' => $parameters,
                'extras' => $optional
            ];

            $query = $this->queryBuilder->buildQuery($args)->selectQuery();

            /* $this->dataMapper->persist($query, $this->dataMapper->buildQueryParameters($conditions)); */

            $this->dataMapper->persist($query, $conditions);

            if ($this->dataMapper->numRows() > 0) {
               return $this->dataMapper->results();
            }

            return [];

        }catch (Throwable $e) {
             throw $e;
        }
    }




    /**
     * @inheritDoc
    */
    public function update(array $fields = [], string $primaryKey = 'id'): bool
    {
        try {

            $args = [
                'table' => $this->getSchema(),
                'type'  => 'update',
                'fields' => $fields,
                'primary_key' => $primaryKey
            ];

            $query = $this->queryBuilder->buildQuery($args)->updateQuery();

            $this->dataMapper->persist($query, $fields);

            if ($this->dataMapper->numRows() == 1) {
                 return true;
            }

            return false;

        } catch (Throwable $e) {
            throw $e;
        }
    }



    /**
     * @inheritDoc
    */
    public function delete(array $conditions = []): bool
    {
        try {

            $args = [
                'table' => $this->getSchema(),
                'type'  => 'delete',
                'conditions' => $conditions
            ];

            $query = $this->queryBuilder->buildQuery($args)->updateQuery();

            $this->dataMapper->persist($query, $conditions);

            if ($this->dataMapper->numRows() == 1) {
                return true;
            }

            return false;

        } catch (Throwable $e) {
            throw $e;
        }
    }




    /**
     * @inheritDoc
     */
    public function search(array $selectors = [], array $conditions = []): array
    {
        try {

            $args = [
                'table' => $this->getSchema(),
                'type'  => 'search',
                'selectors' => $selectors,
                'conditions' => $conditions
            ];

            $query = $this->queryBuilder->buildQuery($args)->searchQuery();

            $this->dataMapper->persist($query, $conditions);

            if ($this->dataMapper->numRows() > 0) {
                return $this->dataMapper->results();
            }

            return [];

        } catch (Throwable $e) {
            throw $e;
        }
    }



    /**
     * @inheritDoc
    */
    public function rawQuery(string $rawQuery, array $conditions = [])
    {
        // TODO: Implement rawQuery() method.
    }
}