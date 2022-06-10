<?php

namespace App\Services\Postmark\Models;

use Illuminate\Database\Eloquent\Model;

class ImportPostmarkServerStats extends Model
{
    protected $table = 'import_postmark_server_stats';
    protected $primaryKey = 'import_postmark_server_stat_id';
    protected $guarded = ['import_postmark_server_stat_id'];

    public function getDataAttribute($value)
    {
        return json_decode($value);
    }
}
