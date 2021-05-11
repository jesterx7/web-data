<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Eloquent;

class Company extends Eloquent
{
    use Sortable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companies';
    protected $primaryKey = 'id_company';
    public $timestamps = false;

    protected $fillable = [
        'nama_company'
    ];

    public $sortable = [
        'id_company', 'nama_company'
    ];

    public function apps()
    {
        return $this->hasMany('App\Apps', 'id_company');
    }
}
