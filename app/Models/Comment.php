<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['rate', 'text', 'user_id', 'order_id'];

    // Relationship To User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Relationship To User
    public function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }

}
