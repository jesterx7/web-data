<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutupBuka extends Model
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
}
