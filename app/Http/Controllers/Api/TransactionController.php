<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use \App\Http\Requests\StoreTransactionRequest;

class TransactionController extends Controller
{
    /**
     * @param StoreTransactionRequest $request
     * @return bool
     */
    public function store(StoreTransactionRequest $request): bool
    {
        //TODO обернуть в транзакцию
        $transaction = new Transaction();
        $transaction->fill($request->validated());
        /** @var Wallet $wallet */
        $wallet = Wallet::findOrFail($transaction->wallet_id);
        if ($transaction->currency_id !== $wallet->currecy_id) {
            //TODO exchange
        }
        $transaction->save();
        $wallet->getRealBalance();
        return true;
    }
}
