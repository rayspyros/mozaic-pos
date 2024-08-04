<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcctPPNSetting extends Model
{
    protected $table        = 'invt_ppn_setting';
    protected $primaryKey   = 'ppn_setting_id';
    protected $guarded = [
        'updated_at',
        'created_at'
    ];
}
