<?php

namespace App\Http\Services;

use App\Http\Requests\StoreTransactionRequest;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

/**
 * Class TransactionService
 *
 * Сервис обработки транзакций
 *
 * @package App\Http\Services
 *
 * @author Aleksandr Gavva
 */
class TransactionService
{
    /**
     * @param StoreTransactionRequest $request
     * @return bool|string
     */
    public function save(StoreTransactionRequest $request)
    {
        DB::beginTransaction();
        try {
            $transaction = new Transaction();
            $transaction->fill($request->validated());
            /** @var Wallet $wallet */
            $wallet = Wallet::findOrFail($transaction->wallet_id);
            if (!$transaction->currency->isEqual($wallet->currency)) {
                $transaction->covertToWalletCurrency($wallet);
            }
            $transaction->save();
            $wallet->updateBalance();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
        DB::commit();
        return true;
    }
}
