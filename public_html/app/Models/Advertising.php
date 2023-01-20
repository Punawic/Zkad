<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertising extends Model
{
    use HasFactory;
    protected $table = 'advertising';
    protected $fillable = [
        'user_id',
        'sale_date',
        'page_campaign_name',
        'advert',
    ]; 
}