<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\Models\Company;

class CompanyController extends Controller
{
    public function add(Request $req)
    {
        $validatedData = $req->validate([
            'brand' => 'required|max:20|min:2',
        ]);

        $company = new App\Models\Company;
        $company->brand = $validatedData['brand'];
        $company->owner_id = Auth::user()->id;
        $company->save();
        return $company;
    }

    public function update(Request $req)
    {
        $validatedData = $req->validate([
            'brand' => 'required|max:20|min:2',
        ]);
        $company = Company::find($validatedData['id']);
        $company->brand = $validatedData['brand'];
        $company->owner_id = $validatedData['owner_id'];
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
