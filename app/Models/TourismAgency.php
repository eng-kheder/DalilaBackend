<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TourismAgency extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'agency_name',
        'city',
        'phone_number',
        'email',
        'location',
        'commercial_record',
        'type_id',
        'price' ,
    ];}
