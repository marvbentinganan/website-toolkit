<?php

namespace App\Services\LogParser\Models;

use Illuminate\Database\Eloquent\Model;

class ImportWebServerLog extends Model
{
    protected $table = 'import_web_server_logs';
    protected $primaryKey = 'import_web_server_log_id';
    protected $guarded = ['import_web_server_log_id'];

    public function getDataAttribute($value)
    {
        return json_decode($value);
    }
}
