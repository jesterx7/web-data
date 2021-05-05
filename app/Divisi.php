<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

class Divisi extends Eloquent
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'divisi';
    protected $primaryKey = 'id_divisi';
    public $timestamps = false;

    protected $fillable = [
        'nama_divisi', 'id_apps', 'status'
    ];

    public function apps()
    {
        return $this->belongsTo('App\Apps', 'id_apps');
    }
}
