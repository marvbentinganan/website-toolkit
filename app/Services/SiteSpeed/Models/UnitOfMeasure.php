<?php

namespace App\Services\SiteSpeed\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitOfMeasure extends Model
{
    use SoftDeletes;

    protected $table = 'unit_of_measures';
    protected $primaryKey = 'unit_of_measure_id';
    protected $guarded = ['unit_of_measure_id'];

    public function sitespeedMetric()
    {
        return $this->belongsToMany(SiteSpeedMetric::class, 'sitespeed_metric_units_of_measure', 'unit_of_measure_id', 'sitespeed_metric_id', 'unit_of_measure_id', 'sitespeed_metric_id');
    }
}
