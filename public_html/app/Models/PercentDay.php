<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PercentDay extends Model
{
    use HasFactory;
    protected $table = 'percent_days';
    protected $fillable = [
         'user_id',
         'return_date',
         'total_delivery_shipped',
         'successful_shipped',
         'in_inventory',
         'returned_successful',
         'way_delivery',
         'way_return',
         'damage',
    ];
}
