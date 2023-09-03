<?php

namespace App\Exceptions;
use Exception;

class TestException extends CustomException{

    public static function oops(): TestException
    {
        return new self('oops');
    }

    public static function siteIsDown(): TestException
    {
        return new self('Site is down, try again later');
    }
}