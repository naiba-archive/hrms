<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;
use App\Models\Company;

class CompanyController extends Controller
{
    public function add(Request $req)
    {
        $validatedData = $req->validate([
            'brand' => 'required|max:20|min:2',
            'created_at' => 'required|date_format:"Y-m-d H:i:s"',
            'updated_at' => 'required|date_format:"Y-m-d H:i:s"',
        ]);
        $company = new \App\Models\Company;
        $company->brand = $validatedData['brand'];
//        $company->owner_id = Auth::user()->id;
        $company->owner_id = $req->owner_id;
        $company->created_at = $validatedData['created_at'];
        $company->updated_at = $validatedData['updated_at'];
        $company->save();
        return $company;
    }

    public function update(Request $req)
    {
        $validatedData = $req->validate([
            'brand' => 'required|max:20|min:2',
        ]);
        $company = Company::find($req->id);
        $company->brand = $validatedData['brand'];
        $company->owner_id = $req->owner_id;
        $company->updated_at = date("Y-m-d H:i:s");
        $company->save();
        return $company;
    }

    public function query(Request $req)
    {
        $company = Company::find($req->id);
        return $company;
    }

    public function delete(Request $req)
    {
        $company = Company::find($req->id);
        $company->delete();
    }

}
