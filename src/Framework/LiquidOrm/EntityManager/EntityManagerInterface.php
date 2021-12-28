<?php
declare(strict_types=1);

namespace Framework\LiquidOrm\EntityManager;


/**
 * @EntityManagerInterface
 *
 * @package Framework\LiquidOrm\EntityManager
*/
interface EntityManagerInterface
{
     /**
      * @return CrudInterface
     */
     public function getCrud(): CrudInterface;
}