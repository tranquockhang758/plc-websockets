<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;
    protected $table = 'datas';
    protected $fillable = [
        'Conveyor_IN',
        'Conveyor_OUT',
        'CYLINDER_GREEN',
        'CYLINDER_BLUE',
        'CYLINDER_YELLOW',
        'GREEN_LIGHT',
        'YELLOW_LIGHT',
        'RED_LIGHT',
        'SIREN',
        'Setting_Prod_GR_in_box',
        'Setting_Prod_BL_in_box',
        'Setting_Prod_YE_in_box',
        'Setting_Box_GR',
        'Setting_Box_BL',
        'Setting_Box_YE',
        'Prod_GR',
        'Prod_BL',
        'Prod_YE',
        'Box_GR',
        'Box_BL',
        'Box_YE',
        'Prod_GR_in_box',
        'Prod_BL_in_box',
        'Prod_YE_in_box',
        'created_at',
        'updated_at'
    ];
}
