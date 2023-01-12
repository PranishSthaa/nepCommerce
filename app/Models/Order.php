<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    public function cart() {
        return $this->belongsTo(Cart::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
