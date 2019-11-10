<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Currency
 *
 * Валюта
 *
 * @package App\Models
 * @property Collection $wallets
 * @property Collection $transactions
 * @property Collection $exchangesFrom
 * @property Collection $exchangesTo
 * @property string $code
 *
 * @author Aleksandr Gavva
 */
class Currency extends Model
{
    /**
     * @return HasMany
     */
    public function wallets(): HasMany
    {
        return $this->hasMany('App\Models\Wallet');
    }

    /**
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany('App\Models\Transaction');
    }

    /**
     * @return HasMany
     */
    public function exchangesFrom(): HasMany
    {
        return $this->hasMany('App\Models\Exchange', 'currency_from');
    }

    /**
     * @return HasMany
     */
    public function exchangesTo(): HasMany
    {
        return $this->hasMany('App\Models\Exchange', 'currency_to');
    }

    /**
     * @param Currency $currency
     * @return bool
     */
    public function isEqual(self $currency): bool
    {
        return $this->id === $currency->id;
    }
}
