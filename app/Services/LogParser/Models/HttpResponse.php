<?php

namespace App\Services\LogParser\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HttpResponse extends Model
{
    use SoftDeletes;

    protected $table = 'http_responses';
    protected $primaryKey = 'http_response_id';
    protected $guarded = ['http_response_id'];
}
