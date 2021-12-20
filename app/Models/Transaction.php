<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'Transactions';

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    /**
     * Get Data Omzet for Merchant and Outlet
     * @param boolean $outlet
     * @return array $data
     */
    public static function _getTransactionDaily($outlet = false)
    {
        $data = new Transaction();
        $data = $data->leftJoin('Merchants', function($join) {
                $join->on('Transactions.merchant_id', '=', 'Merchants.id');
            })
            ->leftJoin('Users', function($join) {
                $join->on('Merchants.user_id', '=', 'Users.id');
            })
            ->select(\DB::raw(
                'DATE_FORMAT(Transactions.created_at, "%Y-%m-%d") as transaction_date,
                Merchants.merchant_name'
            ));

        if($outlet == true) {
            $data = $data->leftJoin('Outlets', function($join) {
                $join->on('Transactions.outlet_id', '=', 'Outlets.id');
            })
            ->addSelect('Outlets.outlet_name')
            ->groupBy('Outlets.outlet_name');
        }

        $data = $data->addSelect(\DB::raw('SUM(Transactions.bill_total) as omzet'));
        $data = $data->where('Users.user_name', Auth::user()->user_name)
            ->groupBy(\DB::raw('DATE_FORMAT(Transactions.created_at, "%Y-%m-%d")'), 'Merchants.merchant_name')
            ->orderBy(\DB::raw('DATE_FORMAT(Transactions.created_at, "%Y-%m-%d")'), 'ASC');

        $data = $data->paginate(5)
            ;

        return $data;
    }

}
