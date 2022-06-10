<?php

namespace App\Services\LogParser\Models;

use Illuminate\Database\Eloquent\Model;

class IpAddress extends Model
{
    protected $table = 'ip_addresses';
    protected $primaryKey = 'ip_address_id';
    protected $guarded = ['ip_address_id'];
    public $timestamps = false;
}
