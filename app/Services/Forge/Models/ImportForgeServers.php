<?php

namespace App\Services\Forge\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImportForgeServers extends Model
{
    use SoftDeletes;

    protected $table = 'import_forge_servers';
    protected $primaryKey = 'import_forge_server_id';
    protected $guarded = ['import_forge_server_id'];

    public function getDataAttribute($value)
    {
        return json_decode($value);
    }
}
