<?php

namespace App\Services\Datadog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DatadogHostApp extends Model
{
    use SoftDeletes;

    protected $table = 'datadog_hosts_apps';

    protected $primaryKey = 'datadog_hosts_apps_id';

    protected $guarded = ['datadog_hosts_apps_id'];
}
