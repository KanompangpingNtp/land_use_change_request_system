<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandChangeNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'land_change_notifications_name',
        'land_change_notifications_quantity_land',
        'land_change_notifications_farm',
        'land_change_notifications_square_wa',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
