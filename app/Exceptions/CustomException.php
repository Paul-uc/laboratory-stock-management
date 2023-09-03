<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{

  public static function internalException(): Static{
     return new static("An internal exception occurred");
  }
}
