<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_no',
        'userId',
       
    ];

    public function products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }
 }
