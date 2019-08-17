<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;
use App\Models\Contract;

class ContractController extends Controller
{
    public function add(Request $req)
    {
        $validatedData = $req->validate([
            'establishment' => 'required|date_format:"Y-m-d H:i:s',
            'deadline' => 'required|date_format:"Y-m-d H:i:s',
            'pay_duration' => 'required|numeric',
        ]);

        $contract = new \App\Models\Contract;
        $contract->house_id = $req->house_id;
        $contract->establishment = $validatedData['establishment'];
        $contract->deadline = $validatedData['deadline'];
        $contract->last_pay = $req->last_pay;
        $contract->pay_duration = $validatedData['pay_duration'];
        $contract->type = $req->type;
        $contract->save();
    }

    public function update(Request $req)
    {
        $validatedData = $req->validate([
            'establishment' => 'required|date_format:"Y-m-d H:i:s',
            'deadline' => 'required|date_format:"Y-m-d H:i:s',
            'pay_duration' => 'required|numeric',
        ]);
        $contract = Contract::find($validatedData['id']);
        $contract->house_id = $req->house_id;
        $contract->establishment = $validatedData['establishment'];
        $contract->deadline = $validatedData['deadline'];
        $contract->last_pay = $req->last_pay;
        $contract->pay_duration = $validatedData['pay_duration'];
        $contract->type = $req->type;
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

        if (array_key_exists('house_id',$_REQUEST) && $_REQUEST['house_id']) {
            $data =  $data->where('house_id',$req->house_id);
        }

        if (array_key_exists('establishment',$_REQUEST) && $_REQUEST['establishment']) {
            $data =  $data->where('establishment', 'like', '%' . $req->establishment . '%');
        }

        if (array_key_exists('deadline',$_REQUEST) && $_REQUEST['deadline']) {
            $data =  $data->where('deadline', 'like', '%' . $req->deadline . '%');
        }

        if (array_key_exists('last_pay',$_REQUEST) && $_REQUEST['last_pay']) {
            $data =  $data->where('last_pay', 'like', '%' . $req->last_pay . '%');
        }


        if (array_key_exists('type',$_REQUEST) && $_REQUEST['type']) {
            $data =  $data->where('type', $req->type);
        }

        $res = $data->get();

        return $res;
    }
}
