<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\Models\Bill;

class BillController extends Controller
{
    public function add(Request $req)
    {
        $validatedData = $req->validate([
            'pay_at' => 'required|dateTime',
            'amount' => 'required|decimal',
        ]);

        $bill = new App\Models\Bill;
        $bill->house_id = $validatedData['house_id'];
        $bill->pay_at = $validatedData['pay_at'];
        $bill->amount = $validatedData['amount'];
        $bill->type = $validatedData['type'];
        $bill->save();
    }

    public function update(Request $req)
    {
        $validatedData = $req->validate([
            'pay_at' => 'required|dateTime',
            'amount' => 'required|decimal',
        ]);
        $bill = Bill::find($validatedData['id']);
        $bill->house_id = $validatedData['house_id'];
        $bill->pay_at = $validatedData['pay_at'];
        $bill->amount = $validatedData['amount'];
        $bill->type = $validatedData['type'];
        $bill->save();
        return $bill;
    }

    public function query(Request $req)
    {
        $bill = Company::find($req->id);
        return $bill;
    }

    public function delete(Request $req)
    {
        $bill = Bill::find($req->id);
        $bill->delete();
    }

    public function queryBill(Request $req){
        $data = DB::table('bills')->select('*');

        if ($_REQUEST['house_id']) {
            $data =  $data->where('house_id',$req->house_id);
        }

        if ($_REQUEST['type']) {
            $data =  $data->where('type',$req->type);
        }

        if ($_REQUEST['pay_at']) {
            $data =  $data->where('pay_at', 'like', '%' . $req->pay_at . '%');
        }

        if ($_REQUEST['amount']) {
            $data =  $data->where('amount', $req->amount);
        }

        $res = $data->get();

        return $res;
    }
}
