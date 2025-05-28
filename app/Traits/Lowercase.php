<?php

namespace App\Traits;

use Illuminate\Http\Request;
trait Lowercase
{
    /**
     * Convert the specified fields in the request to lowercase.
     *
     * @param Request $request
     * @param array $fields
     * @return void
     */
    public function convertToLowercase(Request $request, array $fields)
    {
        foreach ($fields as $field) {
            if ($request->has($field)) {
                $request[$field] = strtolower($request[$field]);
            }
        }
    }
}

