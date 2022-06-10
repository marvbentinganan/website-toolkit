<?php

namespace App\Services\Forge\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForgeServer extends Model
{
    use SoftDeletes;

    protected $table = 'forge_servers';
    protected $primaryKey = 'forge_server_id';
    protected $guarded = ['forge_server_id'];
}
