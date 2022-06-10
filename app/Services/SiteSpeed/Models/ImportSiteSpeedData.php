<?php

namespace App\Services\SiteSpeed\Models;

use Illuminate\Database\Eloquent\Model;

class ImportSiteSpeedData extends Model
{
    protected $table = 'import_sitespeed_data';
    protected $primaryKey = 'import_sitespeed_data_id';
    protected $guarded = ['import_sitespeed_data_id'];

    public function getDataAttribute($value)
    {
        return json_decode($value);
    }
}
