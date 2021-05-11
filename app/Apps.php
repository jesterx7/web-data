<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Eloquent;

class Apps extends Eloquent
{
    use Sortable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'apps';
    protected $primaryKey = 'id_apps';
    public $timestamps = false;

    protected $fillable = [
        'nama_apps', 'link_apps', 'id_company'
    ];

    public $sortable = [
        'id_apps', 'nama_apps', 'link_apps'
    ];

    public function companies()
    {
        return $this->belongsTo('App\Company', 'id_company');
    }

    public function apps()
    {
        return $this->hasMany('App\Divisi', 'id_apps');
    }

    public function leaders()
    {
        return $this->hasMany('App\Leader', 'id_leader');
    }

    public function anaks()
    {
        return $this->hasMany('App\Anak', 'id_anak');
    }
}
