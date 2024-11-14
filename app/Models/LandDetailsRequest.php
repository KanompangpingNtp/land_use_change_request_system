<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandDetailsRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'land_details',
        'land_details_quantity',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
