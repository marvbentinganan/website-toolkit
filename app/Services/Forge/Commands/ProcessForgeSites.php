<?php

namespace App\Services\Forge\Commands;

use App\Models\Domain;
use App\Models\ImportStatus;
use App\Services\Forge\Models\ForgeSite;
use App\Services\Forge\Models\ImportForgeSites;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ProcessForgeSites extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wtk:process-forge-sites';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process imported site data from Laravel Forge';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ImportForgeSites::whereNull('processed_at')->each(function ($siteData) {
            rescue(function () use ($siteData) {
                collect($siteData->data)->each(function ($site) {
                    foreach ($site as $item) {
                        $domainName = Str::of($item->name)
                        ->replace('www.', '')
                        ->trim()->__toString();

                        $this->info('Processing : ' . $item->name);

                        $domain = Domain::where('url', 'like', $domainName)->first();

                        if ($item->name != 'default') {
                            ForgeSite::updateOrCreate(
                                [
                                    'source_id' => $item->id
                                ],
                                [
                                    'domain_id' => isset($domain) ? $domain->getKey() : null,
                                    'name' => $item->name,
                                    'username' => $item->username,
                                    'directory' => $item->directory,
                                    'repository' => $item->repository,
                                    'repository_provider' => $item->repository_provider,
                                    'repository_branch' => $item->repository_branch,
                                    'repository_status' => $item->repository_status,
                                    'project_type' => $item->project_type,
                                    'app' => $item->app,
                                    'php_version' => $item->php_version,
                                    'deployment_url' => $item->deployment_url
                                ]
                            );
                        }
                    }
                });
                $siteData->update(['import_status_id' => ImportStatus::SUCCESS, 'processed_at' => now()]);
            }, function () use ($siteData) {
                $siteData->update(['import_status_id' => ImportStatus::FAILURE]);
            });
        });

        return Command::SUCCESS;
    }
}
