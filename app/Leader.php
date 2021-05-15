<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Eloquent;

class Leader extends Eloquent
{
    use Sortable;
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

    public $sortable = [
        'id_leader', 'username', 'password'
    ];

    public function apps()
    {
        return $this->belongsTo('App\Apps', 'id_apps');
    }

    public function anak()
    {
        return $this->hasMany('App\Anak', 'id_leader');
    }
}
