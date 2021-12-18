<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function index()
    {
        try {

            $data = Outlet::with('Transactions')->with('Merchant')->get();

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
