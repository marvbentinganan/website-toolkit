<?php

namespace App\Services\SiteSpeed\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiteSpeedMetricData extends Model
{
    use SoftDeletes;

    protected $table = 'sitespeed_metric_data';
    protected $primaryKey = 'sitespeed_metric_data_id';
    protected $guarded = ['sitespeed_metric_data_id'];

    public function domain()
    {
        return $this->belongsTo(Domain::class, 'domain_id', 'snipeit_asset_id');
    }
}
