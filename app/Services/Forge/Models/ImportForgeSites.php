<?php

namespace App\Services\Forge\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImportForgeSites extends Model
{
    use SoftDeletes;

    protected $table = 'import_forge_sites';
    protected $primaryKey = 'import_forge_site_id';
    protected $guarded = ['import_forge_site_id'];

    public function getDataAttribute($value)
    {
        return json_decode($value);
    }
}
