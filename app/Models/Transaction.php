<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Transaction
 *
 * Денежные транзакции
 *
 * @package App\Models
 * @property Wallet $wallet
 * @property int $wallet_id
 * @property Currency $currency
 * @property int $currency_id
 * @property float $amount
 * @property string $type
 * @property string $cause
 *
 * @author Aleksandr Gavva
 */
class Transaction extends Model
{
    /**
     * Массив свойств, доступных для массового заполнения
     *
     * @var array
     */
    protected $fillable = ['wallet_id', 'currency_id', 'amount', 'type', 'cause'];

    /**
     * @return BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo('App\Models\Currency');
    }

    /**
     * @return BelongsTo
     */
    public function wallet(): BelongsTo
    {
        return $this->belongsTo('App\Models\Wallet');
    }

    /**
     * Конвертация валюты транзакции в валюту кошелька
     * @param Wallet $wallet
     */
    public function covertToWalletCurrency(Wallet $wallet)
    {
        $this->amount = round(Exchange::convert($this->amount, $this->currency, $wallet->currency), 2);
        $this->currency_id = $wallet->currency_id;
    }
}
