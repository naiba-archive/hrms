<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Bill;

class BillController extends Controller
{
    public function add(Request $req)
    {
        $validatedData = $req->validate([
            'amount' => 'required|numeric',
        ]);

        $bill = new \App\Models\Bill;
        $bill->house_id = $req->house_id;
        $bill->pay_at = date("Y-m-d H:i:s");
        $bill->amount = $validatedData['amount'];
        $bill->type = $req->type;
        $bill->created_at = $validatedData['created_at'];
        $bill->updated_at = $validatedData['updated_at'];
        $bill->save();
        return $bill;
    }

    public function update(Request $req)
    {
        $validatedData = $req->validate([
            'amount' => 'required|numeric',
        ]);
        $bill = Bill::find($req->id);
        $bill->house_id = $req->house_id;
        $bill->pay_at = date("Y-m-d H:i:s");
        $bill->amount = $validatedData['amount'];
        $bill->updated_at = date("Y-m-d H:i:s");
        $bill->type = $req->type;
        $bill->save();
        return $bill;
    }

    public function query(Request $req)
    {
        $bill = Bill::find($req->id);
        return $bill;
    }

    public function delete(Request $req)
    {
        $bill = Bill::find($req->id);
        $bill->delete();
    }

    public function queryBill(Request $req){
        $data = DB::table('bills')->select('*');

        if (array_key_exists('house_id',$_REQUEST) && $_REQUEST['house_id']) {
            $data =  $data->where('house_id',$req->house_id);
        }

        if (array_key_exists('type',$_REQUEST) && $_REQUEST['type']) {
            $data =  $data->where('type',$req->type);
        }

        $res = $data->get();

        return $res;
    }
}
