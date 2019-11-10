<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wallet;

/**
 * Class WalletController
 *
 * @package App\Http\Controllers\Api
 *
 * @author Aleksandr Gavva
 */
class WalletController extends Controller
{
    /**
     * @param int $id
     * @return array
     */
    public function show($id): array
    {
        $wallet = Wallet::findOrFail($id);
        return [
            'balance' => $wallet->balance,
            'currency' => $wallet->currency->code,
        ];
    }
}
