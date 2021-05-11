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
        'id_tutupbuka', 'tanggal_tutup', 'tanggal_buka'
    ];

    public function anak()
    {
        return $this->belongsTo('App\Anak', 'id_anak');
    }
}
