<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'land_details_number',
        'land_details_name',
        'land_details_width',
        'land_details_length',
        'land_details_age',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
