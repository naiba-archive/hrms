<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\Models\House;

class HouseController extends Controller
{
    public function add(Request $req)
    {
        $validatedData = $req->validate([
            'address' => 'required|max:20|min:2',
            'note' => 'required|max:20|min:2',
            'landlord' => 'required|max:20|min:2',
            'landlord_contact' => 'required|max:20|min:2',
        ]);

        $house = new App\Models\House;
        $house->company_id = $validatedData['company_id'];
        $house->parent_id = $validatedData['parent_id'];
        $house->address = $validatedData['address'];
        $house->note = $validatedData['note'];
        $house->landlord = $validatedData['landlord'];
        $house->landlord_contact = $validatedData['landlord_contact'];
        $house->save();
    }

    public function update(Request $req)
    {
        $validatedData = $req->validate([
            'address' => 'required|max:20|min:2',
            'note' => 'required|max:20|min:2',
            'landlord' => 'required|max:20|min:2',
            'landlord_contact' => 'required|max:20|min:2',
        ]);
        $house = House::find($validatedData['id']);
        $house->company_id = $validatedData['company_id'];
        $house->parent_id = $validatedData['parent_id'];
        $house->address = $validatedData['address'];
        $house->note = $validatedData['note'];
        $house->landlord = $validatedData['landlord'];
        $house->landlord_contact = $validatedData['landlord_contact'];
        $house->save();
    }

    public function query(Request $req)
    {
        $house = House::find($req->id);
        return $house;
    }

    public function delete(Request $req)
    {
        $house = House::find($req->id);
        $house->delete();
    }

    public function queryHouse(Request $req){
        $data = DB::table('houses')->select('*');

        if ($_REQUEST['company_id']) {
            $data =  $data->where('company_id',$req->company_id);
        }

        if ($_REQUEST['parent_id']) {
            $data =  $data->where('parent_id',$req->parent_id);
        }

        if ($_REQUEST['address']) {
            $data =  $data->where('address',$req->address);
        }

        if ($_REQUEST['note']) {
            $data =  $data->where('note',$req->note);
        }

        if ($_REQUEST['landlord']) {
            $data =  $data->where('landlord',$req->landlord);
        }

        if ($_REQUEST['landlord_contact']) {
            $data =  $data->where('landlord_contact', $req->landlord_contact);
        }

        $res = $data->get();

        return $res;
    }
}
