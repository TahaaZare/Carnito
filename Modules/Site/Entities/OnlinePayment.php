<?php

namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Payment\Entities\Payment;

class OnlinePayment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }
}
