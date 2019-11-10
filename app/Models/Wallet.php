<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Wallet
 *
 * Кошелек
 *
 * @package App\Models
 * @property User $user
 * @property int $user_id
 * @property Currency $currency
 * @property int $currency_id
 * @property float $balance
 *
 * @author Aleksandr Gavva
 */
class Wallet extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo('App\Models\Currency');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    /**
     * @return float
     */
    public function getRealBalance(): float
    {
        return $this->transactions()->where('type', 'credit')->sum('amount')
        - $this->transactions()->where('type', 'debit')->sum('amount');
    }

    /**
     * @return float
     */
    public function updateBalance(): float
    {
        $this->balance = $this->getRealBalance();
        $this->save();
        return $this->balance;
    }
}
