<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

class Apps extends Eloquent
{
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

    public function companies()
    {
        return $this->belongsTo('App\Company', 'id_company');
    }

    public function apps()
    {
        return $this->hasMany('App\Divisi', 'id_apps');
    }
}
