<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Metrics extends Model
{
    use HasFactory, SoftDeletes;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'metrics';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'metric_id';

    protected $guarded = ['metric_id'];
}
