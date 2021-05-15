<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Eloquent;

class Divisi extends Eloquent
{
    use Sortable;
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

    public $sortable = [
        'id_divisi', 'nama_divisi'
    ];

    public function apps()
    {
        return $this->belongsTo('App\Apps', 'id_apps');
    }

    public function anak()
    {
        return $this->hasMany('App\Anak', 'id_divisi');
    }
}
