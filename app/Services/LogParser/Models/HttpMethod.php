<?php

namespace App\Services\LogParser\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HttpMethod extends Model
{
    use SoftDeletes;

    protected $table = 'http_methods';
    protected $primaryKey = 'http_method_id';
    protected $guarded = ['http_method_id'];
}
