<?php

namespace App\Exceptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Exception;

class InvalidOrderException extends Exception
{
    //
    public function render(Request $request)
    {
        return Redirect::route('home')
            ->withInput()
            ->withErrors([
                'message' => $this->getMessage()
            ])
            ->with('info', $this->getMessage());
    }
}

