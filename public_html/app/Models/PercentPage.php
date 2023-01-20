<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PercentPage extends Model
{
    use HasFactory;
    protected $table = 'percent_pages';
    protected $fillable = [
         'user_id',
         'date',
         'page_campaign_name',
         'total_delivery',
         'recieved',
    ];
}
