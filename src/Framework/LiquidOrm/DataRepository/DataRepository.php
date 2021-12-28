<?php
declare(strict_types=1);

namespace Framework\LiquidOrm\DataRepository;


use Framework\LiquidOrm\DataRepository\Exception\DataRepositoryException;
use Framework\LiquidOrm\DataRepository\Exception\DataRepositoryInvalidArgumentException;
use Framework\LiquidOrm\DataRepository\Exception\DataRepositoryInvalidException;
use Framework\LiquidOrm\EntityManager\EntityManagerInterface;
use MongoDB\BSON\ObjectId;
use Throwable;

/**
 * @DataRepository
*/
class DataRepository implements DataRepositoryInterface
{


    /**
     * @var EntityManagerInterface
    */
    protected EntityManagerInterface $em;



    /**
     * @param EntityManagerInterface $em
    */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    /**
     * @param $conditions
     * @return void
    */
    protected function isArray($conditions)
    {
        if (! is_array($conditions)) {
            throw new DataRepositoryInvalidArgumentException("The argument supplied is not an array.");
        }
    }


    /**
     * @param $id
     * @return void
     */
    protected function isEmpty($id)
    {
        if (empty($id)) {
            throw new DataRepositoryInvalidArgumentException("Argument should not be empty.");
        }
    }


    /**
     * @inheritDoc
    */
    public function find(int $id): array
    {
        // $this->isEmpty($id);

        try {

            return $this->findOneBy(['id' => $id]);

        } catch (Throwable $e) {
            throw $e;
        }
    }



    /**
     * @inheritDoc
    */
    public function findOneBy(array $conditions): array
    {
        // $this->isArray($conditions);

        try {

            return $this->em->getCrud()->read([], $conditions);

        } catch (Throwable $e) {
            throw $e;
        }
    }



    /**
     * @inheritDoc
    */
    public function findAll(): array
    {
        try {

            // get all results
            return $this->em->getCrud()->read();

        } catch (Throwable $e) {
            throw $e;
        }
    }




    /**
     * @inheritDoc
     */
    public function findBy(array $selectors = [], array $conditions = [], array $parameters = [], array $optional = []): array
    {
        try {

            return $this->em->getCrud()->read($selectors, $conditions, $parameters, $optional);

        } catch (Throwable $e) {
            throw $e;
        }
    }




    /**
     * @inheritDoc
    */
    public function findObjectBy(array $conditions = [], array $selectors = []): object
    {
        try {


        } catch (Throwable $e) {
            throw $e;
        }
    }



    /**
     * @inheritDoc
    */
    public function findBySearch(array $selectors = [], array $conditions = [], array $parameters = [], array $optional = []): array
    {
        try {

            // to complete method search()
            return $this->em->getCrud()->search($selectors, $conditions, $parameters, $optional);

        } catch (Throwable $e) {
            throw $e;
        }
    }



    /**
     * @inheritDoc
    */
    public function findByIdAndDelete(array $conditions): bool
    {
        try {

            $result = $this->findOneBy($conditions);

            if ($result != null && count($result) > 0) {

                $delete = $this->em->getCrud()->delete($conditions);

                if ($delete) {
                    return true;
                }
            }

            return false;

        } catch (Throwable $e) {
            throw $e;
        }
    }



    /**
     * @inheritDoc
    */
    public function findByIdAndUpdate(array $fields, int $id): bool
    {
        try {

            $schemaId = $this->em->getCrud()->getSchemaID();

            $result = $this->findOneBy([$schemaId => $id]);

            if ($result != null && count($result) > 0) {

                $params = (! empty($fields)) ? array_merge([$schemaId => $id], $fields) : $fields;

                $update = $this->em->getCrud()->update($params, $schemaId);

                if ($update) {
                    return true;
                }
            }

            return false;

        } catch (Throwable $e) {
            throw $e;
        }
    }



    /**
     * @inheritDoc
    */
    public function findWithSearchAndPaging(array $args, object $request): array
    {
        return [];
    }



    /**
     * @inheritDoc
    */
    public function findAndReturn(int $id, array $selectors = []): DataRepositoryInterface
    {
         return $this;
    }
}