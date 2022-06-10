<?php

namespace App\Services\Postmark\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImportPostmarkServer extends Model
{
    use SoftDeletes;

    protected $table = 'import_postmark_servers';
    protected $primaryKey = 'import_postmark_server_id';
    protected $guarded = ['import_postmark_server_id'];
}
