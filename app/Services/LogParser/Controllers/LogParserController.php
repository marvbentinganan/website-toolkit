<?php

namespace App\Services\LogParser\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Server;
use App\Services\LogParser\Jobs\CreateImportWebServerLog;
use Illuminate\Http\Request;

class LogParserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('server')) {
            $servers = Server::with(['domains' => function ($query) {
                $query->where('parse_logs', true);
            }])
                ->where('name', 'ilike', $request->get('server'))
                ->first();

            if (!$servers) {
                return [];
            }

            return $servers->domains->values();
        }

        return response('', 200);
    }

    public function create(Request $request)
    {
        $request->validate([
            'data' => ['required']
        ]);

        $data = collect($request->get('data'));

        $data->each(function ($log) use ($request) {
            CreateImportWebServerLog::dispatch($request->except('data'), $log);
        });

        return response('', 202);
    }
}
