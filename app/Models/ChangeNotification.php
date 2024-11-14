<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'land_change_notifications_quantity',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
