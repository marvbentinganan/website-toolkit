<?php

namespace App\Services\LogParser\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebServer extends Model
{
    use SoftDeletes;

    const NGINX = 1;
    const APACHE = 2;

    protected $table = 'web_servers';
    protected $primaryKey = 'web_server_id';
    protected $guarded = ['web_server_id'];
}
