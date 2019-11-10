<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\TransactionService;
use \App\Http\Requests\StoreTransactionRequest;

/**
 * Class TransactionController
 *
 * @package App\Http\Controllers\Api
 *
 * @author Aleksandr Gavva
 */
class TransactionController extends Controller
{
    /**
     * @var TransactionService
     */
    private $transactionService;
    /**
     * TransactionController constructor.
     */
    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * @param StoreTransactionRequest $request
     * @return array
     */
    public function store(StoreTransactionRequest $request): array
    {
        if (true === $result = $this->transactionService->save($request)) {
            return [
                'success' => $result
            ];
        }
        return [
            'success' => !$result,
            'errors' => $result
        ];
    }
}
