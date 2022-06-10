<?php

use App\Models\Server;
use App\Services\WebsiteCustodian\Middleware\AuthenticateAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(AuthenticateAgent::class)->group(function () {
    Route::get('/processing/agents', function (Request $request) {
        if ($request->has('server')) {
            $servers = Server::with(['domains'])
                ->where('name', 'ilike', $request->get('server'))
                ->first();

            if (!$servers) {
                return [];
            }

            return $servers->domains->values();
        }

        return response('', 200);
    });

    Route::get('/processing/logs', [LogParserController::class, 'index']);
    Route::post('/processing/logs', [LogParserController::class, 'create']);
});
