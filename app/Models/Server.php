<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $table = 'servers';
    protected $primaryKey = 'server_id';
    protected $fillable = [
        'name',
        'snipeit_asset_id',
        'snipeit_disk_storage',
        'snipeit_memory',
        'snipeit_cpu',
        'snipeit_ip_address',
        'snipeit_hostname',
        'snipeit_operating_system',
        'snipeit_datadog_integration',
        'snipeit_server_type',
        'snipeit_provisioned_in',
        'snipeit_description',
        'snipeit_country',
        'snipeit_data_center',
        'laravel_forge_server_id'
    ];

    public function domains()
    {
        return $this->belongsToMany(Domain::class, 'domains_servers', 'server_id', 'domain_id')
            ->withPivot(['scan_enabled', 'root_path']);
    }

    public function getSnipeitDiskStorageAttribute($value)
    {
        if ($value) {
            return $value.' GB';
        }

        return $value;
    }

    public function getSnipeitMemoryAttribute($value)
    {
        if ($value) {
            return $value.' GB';
        }

        return $value;
    }

    public function getSnipeitCpuAttribute($value)
    {
        if ($value) {
            return $value.'-vcpu';
        }

        return $value;
    }
}
