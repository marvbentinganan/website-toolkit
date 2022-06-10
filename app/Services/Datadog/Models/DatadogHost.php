<?php

namespace App\Services\Datadog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DatadogHost extends Model
{
    use SoftDeletes;

    protected $table = 'datadog_hosts';

    protected $primaryKey = 'datadog_host_id';

    protected $guarded = ['datadog_host_id'];
}
