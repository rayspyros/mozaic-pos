<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPNCompanySetting extends Model
{
    // use HasFactory;
    protected $table        = 'ppn_company_setting';
    protected $primaryKey   = 'ppn_setting_id';
    protected $guarded = [
        'updated_at',
        'created_at'
    ];
}
