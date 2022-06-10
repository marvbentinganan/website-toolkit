<?php

namespace App\Services\Datadog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImportDatadogHost extends Model
{
    use SoftDeletes;

    protected $table = 'import_datadog_hosts';

    protected $primaryKey = 'import_datadog_host_id';

    protected $guarded = ['import_datadog_host_id'];

    public function getDataAttribute($value)
    {
        return json_decode($value);
    }
}
