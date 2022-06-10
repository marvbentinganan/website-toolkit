<?php

namespace App\Services\LogParser\Models;

use Illuminate\Database\Eloquent\Model;

class DomainUrl extends Model
{
    protected $table = 'domain_urls';
    protected $primaryKey = 'domain_url_id';
    protected $guarded = ['domain_url_id'];
}
