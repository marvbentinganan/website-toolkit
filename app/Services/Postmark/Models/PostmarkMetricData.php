<?php

namespace App\Services\Postmark\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostmarkMetricData extends Model
{
    use SoftDeletes;

    protected $table = 'postmark_metric_data';
    protected $primaryKey = 'postmark_metric_data_id';
    protected $guarded = ['postmark_metric_data_id'];
}
