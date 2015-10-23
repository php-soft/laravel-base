<?php

namespace PhpSoft\Base\Validation;

use Closure;
use Validator;

class Middleware
{
    public function handle($request, Closure $next, $classValidate)
    {
        $classValidate::boot($request);
        $validator = Validator::make($request->all(), $classValidate::rules());

        if ($validator->fails()) {
            return response()->json(arrayView('phpsoft.base::errors/validation', [
                'errors' => $validator->errors()
            ]), 400);
        }

        return $next($request);
    }
}
