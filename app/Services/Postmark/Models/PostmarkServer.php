<?php

namespace App\Services\Postmark\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostmarkServer extends Model
{
    use SoftDeletes;

    protected $table = 'postmark_servers';
    protected $primaryKey = 'postmark_server_id';
    protected $guarded = ['postmark_server_id'];
}
