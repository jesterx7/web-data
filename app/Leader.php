<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'leaders';
    protected $primaryKey = 'id_leader';
    public $timestamps = false;

    protected $fillable = [
        'username', 'password', 'id_apps', 'id_divisi', 'status'
    ];
}
