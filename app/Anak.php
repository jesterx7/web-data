<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'anak';
    protected $primaryKey = 'id_anak';
    public $timestamps = false;

    protected $fillable = [
        'username', 'password', 'id_apps', 'id_divisi', 'id_leader', 'status'
    ];
}
