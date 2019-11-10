<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    public function currency()
    {
        return $this->belongsTo('App\Models\Currency');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    public function getRealBalance()
    {
        return $this->transactions()->where('type', 'credit')->sum('amount')
        - $this->transactions()->where('type', 'debit')->sum('amount');
    }
}
