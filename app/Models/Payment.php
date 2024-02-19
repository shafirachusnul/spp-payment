<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'fee',
        'title',
        'description',
        'deadline',
    ];

    public $timestamps = false;

    public function paymentHeaders(){
        return $this->hasMany(PaymentHeader::class, 'payment_id','id');
    }
}
