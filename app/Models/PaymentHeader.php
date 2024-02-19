<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHeader extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_id',
        'is_payment_done',
        'is_notify_done',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function payment(){
        return $this->belongsTo(Payment::class,'payment_id','id');
    }
}
