<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wallet;

class WalletController extends Controller
{
    /**
     * @param int $id
     * @return array
     */
    public function show($id): array
    {
        $wallet = Wallet::findOrFail($id);
        return [$id => $wallet->balance];
    }
}
