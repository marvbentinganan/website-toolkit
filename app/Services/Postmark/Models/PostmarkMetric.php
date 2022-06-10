<?php

namespace App\Services\Postmark\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostmarkMetric extends Model
{
    use SoftDeletes;

    protected $table = 'postmark_metrics';
    protected $primaryKey = 'postmark_metric_id';
    protected $guarded = ['postmark_metric_id'];
}
