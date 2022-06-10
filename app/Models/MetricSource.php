<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetricSource extends Model
{
    use HasFactory, SoftDeletes;

    const HETRIX = 1;
    const DATADOG = 2;
    const BUGSNAG = 3;
    const SITESPEED = 4;
    const POSTMARK = 5;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'metric_sources';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'metric_source_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['metric_source_id'];
}
