<?php

namespace App\Services\SiteSpeed\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiteSpeedMetric extends Model
{
    use SoftDeletes;

    protected $table = 'sitespeed_metrics';
    protected $primaryKey = 'sitespeed_metric_id';
    protected $guarded = ['sitespeed_metric_id'];

    public function unitOfMeasure()
    {
        return $this->belongsToMany(UnitOfMeasure::class, 'sitespeed_metric_units_of_measure', 'sitespeed_metric_id', 'unit_of_measure_id', 'sitespeed_metric_id', 'unit_of_measure_id');
    }
}
