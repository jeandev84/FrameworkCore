<?php
declare(strict_types=1);

namespace Framework\LiquidOrm\EntityManager;

/**
 * @EntityManager
 *
 * @package Framework\LiquidOrm\EntityManager
*/
class EntityManager implements EntityManagerInterface
{

    /**
     * @var CrudInterface
    */
    protected CrudInterface $crud;



    /**
     * Main constructor class
     *
     * @return void
    */
    public function __construct(CrudInterface $crud)
    {
         $this->crud = $crud;
    }




    /**
     * @inheritDoc
    */
    public function getCrud(): object
    {
       return $this->crud;
    }
}