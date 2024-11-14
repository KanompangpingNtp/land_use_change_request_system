<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'request_date',
        'guest_salutation',
        'guest_name',
        'guest_age',
        'guest_phone',
        'guest_house_number',
        'guest_village',
        'guest_subdistrict',
        'guest_district',
        'guest_province',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attachments()
    {
        return $this->hasMany(FormAttachment::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function landOwnerDetails()
    {
        return $this->hasOne(FormLandOwnerDetail::class);
    }

    public function landDetailsRequests()
    {
        return $this->hasMany(LandDetailsRequest::class);
    }

    public function landDetails()
    {
        return $this->hasMany(LandDetail::class);
    }

    public function changeNotifications()
    {
        return $this->hasMany(ChangeNotification::class);
    }

    public function landChangeNotifications()
    {
        return $this->hasMany(LandChangeNotification::class);
    }
}
