<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;
use App\Models\House;

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

        $house = new \App\Models\House;
        $house->company_id = $req->company_id;
        $house->parent_id = $req->parent_id;
        $house->address = $validatedData['address'];
        $house->note = $validatedData['note'];
        $house->landlord = $validatedData['landlord'];
        $house->landlord_contact = $validatedData['landlord_contact'];
        $house->created_at = date("Y-m-d H:i:s");
        $house->updated_at = date("Y-m-d H:i:s");
        $house->save();
        return $house;
    }

    public function update(Request $req)
    {
        $validatedData = $req->validate([
            'address' => 'required|max:20|min:2',
            'note' => 'required|max:20|min:2',
            'landlord' => 'required|max:20|min:2',
            'landlord_contact' => 'required|max:20|min:2',
        ]);
        $house = House::find($req->id);
        $house->company_id = $req->company_id;
        $house->parent_id = $req->parent_id;
        $house->address = $validatedData['address'];
        $house->note = $validatedData['note'];
        $house->landlord = $validatedData['landlord'];
        $house->landlord_contact = $validatedData['landlord_contact'];
        $house->updated_at = date("Y-m-d H:i:s");
        $house->save();
        return $house;
    }

    public function delete(Request $req)
    {
        $house = House::find($req->id);
        $house->delete();
    }

    public function query(Request $req){
        $data = DB::table('houses')->select('*');

        if (array_key_exists('id',$_REQUEST) && $_REQUEST['id']) {
            $house = House::find($req->id);
            return $house;
        }

        if (array_key_exists('company_id',$_REQUEST) && $_REQUEST['company_id']) {
            $data =  $data->where('company_id',$req->company_id);
        }

        if (array_key_exists('parent_id',$_REQUEST) && $_REQUEST['parent_id']) {
            $data =  $data->where('parent_id',$req->parent_id);
        }

        if (array_key_exists('address',$_REQUEST) && $_REQUEST['address']) {
            $data =  $data->where('address',$req->address);
        }

        if (array_key_exists('note',$_REQUEST) && $_REQUEST['note']) {
            $data =  $data->where('note',$req->note);
        }

        if (array_key_exists('landlord',$_REQUEST) && $_REQUEST['landlord']) {
            $data =  $data->where('landlord',$req->landlord);
        }

        if (array_key_exists('landlord_contact',$_REQUEST) && $_REQUEST['landlord_contact']) {
            $data =  $data->where('landlord_contact', $req->landlord_contact);
        }

        $res = $data->get();

        return $res;
    }
}
