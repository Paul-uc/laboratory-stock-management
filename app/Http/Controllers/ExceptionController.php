<?php

namespace App\Http\Controllers;

use App\Exceptions\TestException;
use Illuminate\Http\Request;

class ExceptionController extends Controller
{
    //
    public function __invoke()
    {
      
        $this->makeSomethingRisky();
      
        return response()->json(['message' => 'HI']);
    }

    protected function makeSomethingRisky()
    {
        throw TestException::internalException();
    }
}
