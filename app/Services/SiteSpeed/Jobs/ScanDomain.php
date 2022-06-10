<?php

namespace App\Services\SiteSpeed\Jobs;

use App\Services\SiteSpeed\Models\ImportSiteSpeedData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class ScanDomain implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Queueable;

    protected $domain;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * The maximum number of unhandled exceptions to allow before failing.
     *
     * @var int
     */
    public $maxExceptions = 1;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 180;

    /**
     * Create a new job instance.
     *
     * @param Domain $domain
     */
    public function __construct($domain)
    {
        $this->domain = $domain;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $dockerNameUuid = Str::uuid()->toString();

        $command = collect([
            'docker',
            'run',
            '--name',
            $dockerNameUuid,
            '--rm',
            '-v',
            sprintf('%s:%s', storage_path('app'), '/sitespeed.io'),
            'sitespeedio/sitespeed.io:21.3.0',
            sprintf('%s', $this->domain->full_url),
            '--plugins.add',
            'analysisstorer',
            '--video',
            'false',
            '-n',
            '1',
        ]);

        $process = new Process($command->toArray());
        // Timeout is in seconds.
        $process->setTimeout(60 * 10)->run();

        if (!$process->isSuccessful()) {
            logger()->error('Sitespeed failed to run', [
                'error-output' => $process->getErrorOutput(),
                'main-output' => $process->getOutput(),
            ]);
        }

        $parsedData = $this->processData($process->getOutput());

        ImportSiteSpeedData::create([
            'docker_process_uuid' => $dockerNameUuid,
            'domain_id' => $this->domain->getKey(),
            'snipeit_asset_id' => $this->domain->snipeit_asset_id,
            'data' => collect($parsedData)
        ]);

        $killDockerProcess = new Process(['docker', 'rm', '-f', $dockerNameUuid]);
        $killDockerProcess->setTimeout(60 * 10)->run();

        return;
    }

    private function processData($output)
    {
        $initialMatch = Str::of($output)
            ->match('/INFO: HTML.+/')
            ->explode(' ')
            ->last();

        $resultsPath = Str::of($initialMatch)
            ->trim()
            ->replace('\n', '')
            ->replace('/sitespeed.io', '');

        $files = Storage::allFiles($resultsPath);

        return [
            'coach' => $this->processCoach($files),
            'browsertime' => $this->processBrowsertime($files),
            'pagexray' => $this->processPageXRay($files),
        ];
    }

    private function processCoach($files)
    {
        return $this->getFileData($files, 'coach.summary-total.json');
    }

    private function getFileData($files, $fileName)
    {
        return collect($files)->filter(function ($file) use ($fileName) {
            return Str::contains($file, [
                $fileName,
            ]);
        })->map(function ($file) {
            return json_decode(Storage::get($file));
        })->first();
    }

    private function processBrowsertime($files)
    {
        return $this->getFileData($files, 'browsertime.summary-total.json');
    }

    private function processPageXRay(array $files)
    {
        return $this->getFileData($files, 'pagexray.summary-total.json');
    }
}
