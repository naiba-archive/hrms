<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function add(Request $req)
    {
        $validatedData = $req->validate([
            'brand' => 'required|max:20|min:2',
        ]);

        $comp = new App\Models\Company;
        $comp->brand = $validatedData['brand'];
        $comp->owner_id = Auth::user()->id;
        $comp->save();
    }
}
