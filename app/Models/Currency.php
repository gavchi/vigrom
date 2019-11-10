<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends Model
{
    public function wallets(): HasMany
    {
        return $this->hasMany('App\Models\Wallet');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany('App\Models\Transaction');
    }
}
