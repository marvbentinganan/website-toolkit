<?php

namespace App\Services\LogParser\Models;

use Illuminate\Database\Eloquent\Model;

class WebServerLog extends Model
{
    protected $table = 'web_server_logs';
    protected $primaryKey = 'web_server_log_id';
    protected $guarded = ['web_server_log_id'];
}
