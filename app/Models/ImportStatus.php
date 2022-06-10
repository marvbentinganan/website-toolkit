<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportStatus extends Model
{
    /**
     * Model Constants
     */
    const PENDING = 1;
    const SUCCESS = 2;
    const FAILURE = 3;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'import_statuses';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'import_status_id';

    protected $guarded = ['import_status_id'];
}
