<?php

namespace App\Http\Controllers;

use App\Models\ImportIncomingWebhook;
use App\Models\MetricSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Models\ImportStatus;

class WebhookController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'key' => ['required', 'exists:metric_sources,incoming_webhook_key']
        ]);


        dispatch(function() use ($request) {
            $metricSource = MetricSource::where('incoming_webhook_key', $request->get('key'))->firstOrFail();

            $importIncomingWebhook = new ImportIncomingWebhook();
            $importIncomingWebhook->import_status_id = ImportStatus::PENDING;
            $importIncomingWebhook->metric_source_id = $metricSource->getKey();
            $importIncomingWebhook->json_payload = $request->getContent();
            $importIncomingWebhook->save();
        })->afterResponse();


        return response('', 200);
    }
}
