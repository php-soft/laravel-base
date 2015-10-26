<?php

use Illuminate\Http\Request;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        Route::post('/user', ['middleware'=>'validate:App\Http\Validators\UserValidate',
            function () {
                return response()->json(null, 200);
            }
        ]);

        Route::post('/comments', ['middleware'=>'inputCamelToSnake',
            function (Request $request) {
                return response()->json($request->all(), 200);
            }
        ]);

        return $app;
    }
}
