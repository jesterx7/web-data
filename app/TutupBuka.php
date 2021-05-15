<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Eloquent;

class TutupBuka extends Eloquent
{
    use Sortable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tutup_buka';
    protected $primaryKey = 'id_tutupbuka';
    public $timestamps = false;

    protected $fillable = [
        'tanggal_tutup', 'tanggal_buka', 'id_anak', 'status'
    ];

    public $sortable = [
        'id_tutupbuka', 'tanggal_tutup', 'tanggal_buka', 'apps'
    ];

    public function anak()
    {
        return $this->belongsTo('App\Anak', 'id_anak');
    }
    
    protected function appsSortable($query, $order)
    {
        return $query->join('anak', 'tutup_buka.id_anak', '=', 'anak.id_anak')
                     ->join('apps', 'anak.id_apps', '=', 'apps.id_apps')
                     ->orderBy('apps.nama_apps', $order)
                     ->select('tutup_buka.*');
    }
}
