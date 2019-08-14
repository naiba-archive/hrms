<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\Models\Contract;

class ContractController extends Controller
{
    public function add(Request $req)
    {
        $validatedData = $req->validate([
            'establishment' => 'required|dateTime',
            'deadline' => 'required|dateTime',
            'last_pay' => 'required|dateTime',
            'last_pay' => 'required|dateTime',
            'pay_duration' => 'required|dateTime',
        ]);

        $contract = new App\Models\Contract;
        $contract->house_id = $validatedData['house_id'];
        $contract->establishment = $validatedData['establishment'];
        $contract->deadline = $validatedData['deadline'];
        $contract->last_pay = $validatedData['last_pay'];
        $contract->pay_duration = $validatedData['pay_duration'];
        $contract->type = $validatedData['type'];
        $contract->save();
    }

    public function update(Request $req)
    {
        $validatedData = $req->validate([
            'establishment' => 'required|dateTime',
            'deadline' => 'required|dateTime',
            'last_pay' => 'required|dateTime',
            'last_pay' => 'required|dateTime',
            'pay_duration' => 'required|dateTime',
        ]);
        $contract = Contract::find($validatedData['id']);
        $contract->house_id = $validatedData['house_id'];
        $contract->establishment = $validatedData['establishment'];
        $contract->deadline = $validatedData['deadline'];
        $contract->last_pay = $validatedData['last_pay'];
        $contract->pay_duration = $validatedData['pay_duration'];
        $contract->type = $validatedData['type'];
        $contract->save();
        return $contract;
    }

    public function query(Request $req)
    {
        $contract = Contract::find($req->id);
        return $contract;
    }

    public function delete(Request $req)
    {
        $contract = Contract::find($req->id);
        $contract->delete();
    }

    public function queryContract(Request $req){
        $data = DB::table('contracts')->select('*');

        if ($_REQUEST['house_id']) {
            $data =  $data->where('house_id',$req->house_id);
        }

        if ($_REQUEST['establishment']) {
            $data =  $data->where('establishment', 'like', '%' . $req->establishment . '%');
        }

        if ($_REQUEST['deadline']) {
            $data =  $data->where('deadline', 'like', '%' . $req->deadline . '%');
        }

        if ($_REQUEST['last_pay']) {
            $data =  $data->where('last_pay', 'like', '%' . $req->last_pay . '%');
        }

        if ($_REQUEST['pay_duration']) {
            $data =  $data->where('pay_duration', 'like', '%' . $req->pay_duration . '%');
        }

        if ($_REQUEST['type']) {
            $data =  $data->where('type', $req->type);
        }

        $res = $data->get();

        return $res;
    }
}
