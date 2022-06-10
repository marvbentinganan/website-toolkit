<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'domains';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'domain_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['domain_id'];

    /**
     * Get the urls that the domain is associated with.
     */
    public function urls()
    {
        return $this->hasMany(Url::class, 'domain_id', 'domain_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function servers()
    {
        return $this->belongsToMany(Server::class, 'domains_servers', 'domain_id', 'server_id');
    }

    /**
     * Get the website directories that belong to this domain.
     */
    public function websiteDirectories()
    {
        return $this->hasMany(WebsiteDirectoryLog::class, 'domain_id', 'domain_id');
    }

    /**
     * Get the website plugins that belong to this domain.
     */
    public function websitePlugins()
    {
        return $this->hasMany(WebsitePluginLog::class, 'domain_id', 'domain_id');
    }

    /**
     * Get the website themes that belong to this domain.
     */
    public function websiteThemes()
    {
        return $this->hasMany(WebsiteThemeLog::class, 'domain_id', 'domain_id');
    }

    /**
     * Get the website versions that belong to this domain.
     */
    public function websiteVersions()
    {
        return $this->hasMany(WebsiteVersionLog::class, 'domain_id', 'domain_id');
    }
}
