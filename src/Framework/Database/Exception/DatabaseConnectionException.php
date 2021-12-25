<?php
declare(strict_types=1);


namespace Framework\Database\Exception;


use PDOException;
use Throwable;


/**
 * @DatabaseConnectionException
 *
 * @package Framework\Database\Exception
*/
class DatabaseConnectionException extends PDOException
{

      protected $message;


      protected $code;


      /**
       * @param null $message
       * @param null $code
      */
      public function __construct($message = null, $code = null)
      {
           $this->message = $message;
           $this->code    = $code;
      }
}