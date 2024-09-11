<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [ 'user_id', 'address', 'city', 'postal_code', 'country', 'payment_status', 'payment_method'];
}
