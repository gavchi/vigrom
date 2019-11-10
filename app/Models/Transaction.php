<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    public function currency(): BelongsTo
    {
        return $this->belongsTo('App\Models\Currency');
    }

    public function wallet(): BelongsTo
    {
        return $this->belongsTo('App\Models\Wallet');
    }
}
