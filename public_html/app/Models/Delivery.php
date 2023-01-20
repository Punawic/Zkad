<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $table = 'deliveries';
    protected $fillable = [
         'user_id',
         'page_campaign_name',
         'cost',
         'delivery_fee',
         'cod',
    ];
}
