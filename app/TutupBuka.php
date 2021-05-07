<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

class TutupBuka extends Eloquent
{
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

    public function anak()
    {
        return $this->belongsTo('App\Anak', 'id_anak');
    }
}
