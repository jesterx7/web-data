<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Eloquent;

class Anak extends Eloquent
{
    use Sortable;
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

    public $sortable = [
        'id_anak', 'username', 'password'
    ];

    public function leaders()
    {
        return $this->belongsTo('App\Leader', 'id_leader');
    }

    public function divisi()
    {
        return $this->belongsTo('App\Divisi', 'id_divisi');
    }

    public function apps()
    {
        return $this->belongsTo('App\Apps', 'id_apps');
    }
    
    public function tutupbuka()
    {
        return $this->hasMany('App\TutupBuka', 'id_anak');
    }
}
