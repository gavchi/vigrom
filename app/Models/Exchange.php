<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Exchange
 *
 * Курсы валют
 *
 * @package App\Models
 * @property Currency $from_currency
 * @property Currency $to_currency
 * @property int $currency_from
 * @property int $currency_to
 * @property float $multiplier
 *
 * @author Aleksandr Gavva
 */
class Exchange extends Model
{
    /**
     * @return BelongsTo
     */
    public function fromCurrency(): BelongsTo
    {
        return $this->belongsTo('App\Models\Currency', 'currency_from');
    }

    /**
     * @return BelongsTo
     */
    public function toCurrency(): BelongsTo
    {
        return $this->belongsTo('App\Models\Currency', 'currency_from');
    }

    /**
     * Конвертация одной валюты в другую по последнему актуальному курсу
     *
     * @param int $amount
     * @param Currency $from
     * @param Currency $to
     * @return float
     * @throws ModelNotFoundException
     */
    public static function convert(int $amount, Currency $from, Currency $to): float
    {
        $currentExchangeRate = static::where(
            [
                'currency_from' => $from->id,
                'currency_to' => $to->id
            ]
        )
            ->latest()
            ->first();
        if (!$currentExchangeRate) {
            throw new ModelNotFoundException();
        }

        return $amount * $currentExchangeRate->multiplier;
    }
}
