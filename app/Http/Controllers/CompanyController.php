<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        return view('dashboard.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'username'=>'required|unique:users,username',
            'password'=>'required',
            'name'=>'required'
        ]);

        if($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $upload_dir = public_path() . '/uploads';
            $filename = uniqid() . $logo->getClientOriginalName();
            $logo->move($upload_dir, $filename);
        } else {
            $filename = 'logo-placeholder.jpg';
        }

        $company = Company::create([
            'name'=>$request->name,
            'logo'=>$filename,
            'about'=>$request->about,
            'user_id'=>1
        ]);

        $company_user =  User::create([
            'name'=>$request->name,
            'username'=>$request->username,
            'avatar'=>$filename,
            'password'=>bcrypt($request->password)
        ]);

        $company->update([
            'user_id'=>$company_user->id
        ]);
        $company_user->assignRole('company');

        return redirect()->route('companies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('dashboard.company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('dashboard.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {

        if($request->hasFile('logo')) {
            unlink(public_path() . '/uploads/company/' . $company->logo);
            $logo = $request->file('logo');
            $upload_dir = public_path() . '/uploads/company';
            $filename = uniqid() . $logo->getClientOriginalName();
            $logo->move($upload_dir, $filename);
            $company->update([
                'logo'=>$filename,
            ]);
        }


        $company->update([
            'name'=>$request->name,
            'about'=>$request->about,
        ]);
        if($request->password) {
        $company->update([
            'password'=>bcrypt($request->password)
        ]);
        }


        return redirect()->route('companies.show', $company->id);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        if($company->logo != 'logo-placeholder.jpg') {
            unlink(public_path() . '/uploads/company/' . $company->logo);
        }
        $company->user->delete();
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company Deleted Succesfully');
    }
}
