<?php
declare(strict_types=1);

namespace Framework\LiquidOrm\DataRepository;

/**
 * @DataRepositoryInterface
*/
interface DataRepositoryInterface
{

     /**
      * @param int $id
      * @return array
     */
     public function find(int $id): array;




     /**
      * @return array
     */
     public function findAll(): array;



     /**
      * @param array $selectors
      * @param array $conditions
      * @param array $parameters
      * @param array $optional
      * @return array
     */
     public function findBy(array $selectors = [], array $conditions = [], array $parameters = [], array $optional = []): array;



     /**
      * @param array $conditions
      * @return array
     */
     public function findOneBy(array $conditions): array;



     /**
      * @param array $conditions
      * @param array $selectors
      * @return object
     */
     public function findObjectBy(array $conditions = [], array $selectors = []): object;




     /**
      * @param array $selectors
      * @param array $conditions
      * @param array $parameters
      * @param array $optional
      * @return array
     */
     public function findBySearch(array $selectors = [], array $conditions = [], array $parameters = [], array $optional = []): array;



     /**
      * @param array $conditions
      * @return bool
     */
     public function findByIdAndDelete(array $conditions): bool;



     /**
      * @param array $fields
      * @param int $id
      * @return bool
     */
     public function findByIdAndUpdate(array $fields, int $id): bool;




     /**
      * @param array $args
      * @param object $request
      * @return array
     */
     public function findWithSearchAndPaging(array $args, object $request): array;




     /**
      * @param int $id
      * @param array $selectors
      * @return $this
     */
     public function findAndReturn(int $id, array $selectors = []): self;
}