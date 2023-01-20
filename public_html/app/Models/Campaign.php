<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    protected $table = 'campaigns';
    protected $fillable = [
       'user_id',
       'campaign_id',
       'campaign_name',
       'page_id',
       'budget',
       'keyword',
       'duty',
       'product_name',
       'location',
       'sale_price',
       'description',
       'image',
       'status'
    ];
}
