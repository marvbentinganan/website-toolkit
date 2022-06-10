<?php

namespace App\Services\Forge\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForgeSite extends Model
{
    use SoftDeletes;

    protected $table = 'forge_sites';
    protected $primaryKey = 'forge_site_id';
    protected $guarded = ['forge_site_id'];
}
