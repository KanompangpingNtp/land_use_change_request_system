<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormLandOwnerDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'land_owner_details_name',
        'land_owner_details_area',
        'land_owner_details_farm',
        'land_owner_details_square_wa',
        'land_owner_details_village',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
