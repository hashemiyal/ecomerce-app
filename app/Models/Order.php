<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table ='orders';
    protected $fillable = ["user_id","tracking_no","fullname","email","address","pincode","status_msg","payment_mode","payment_id","phone"];
}
