<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function index()
    {
        try {

            $data = Merchant::with('Outlets')->with('Transactions')->with('User')->get();

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
}
