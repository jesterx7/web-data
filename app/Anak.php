<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

class Anak extends Eloquent
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

    public function leaders()
    {
        return $this->belongsTo('App\Leader', 'id_leader');
    }

    public function divisi()
    {
        return $this->belongsTo('App\Divisi', 'id_divisi');
    }
}
