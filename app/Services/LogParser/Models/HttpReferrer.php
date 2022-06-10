<?php

namespace App\Services\LogParser\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HttpReferrer extends Model
{
    use SoftDeletes;

    protected $table = 'http_referrers';
    protected $primaryKey = 'http_referrer_id';
    protected $guarded = ['http_referrer_id'];
}
