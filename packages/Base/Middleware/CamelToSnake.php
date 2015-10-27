<?php

namespace PhpSoft\Base\Middleware;

use Closure;

class CamelToSnake
{
    public function handle($request, Closure $next)
    {
        $inputs = $request->all();
        $newInputs = [];

        foreach ($inputs as $key => $value) {
            $newInputs[] = [snake_case($key) => $value];
        }

        $request->replace($newInputs);

        return $next($request);
    }
}
