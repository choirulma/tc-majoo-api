<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        try {

            $data = Transaction::all();

            return response([
                'code' => 200,
                'message' => 'Data retrieved successfully',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response([
                'code' => 400,
                'message' => 'Bad Request',
            ]);
        }
    }

    public function dailyMerchant()
    {
        try {

            $data = Transaction::_getTransactionDaily();

            return response([
                'code' => 200,
                'message' => 'Data retrieved successfully',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response([
                'code' => 400,
                'message' => 'Bad Request \n' . $e,
            ]);
        }
    }

    public function dailyOutlet()
    {
        try {

            $data = Transaction::_getTransactionDaily(true);

            return response([
                'code' => 200,
                'message' => 'Data retrieved successfully',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response([
                'code' => 400,
                'message' => 'Bad Request \n' . $e,
            ]);
        }
    }
}
