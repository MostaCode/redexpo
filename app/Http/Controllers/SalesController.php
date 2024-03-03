<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agent;
use App\Models\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if($user->hasRole('superadmin')) {
            $all_sales = Sales::all()->sortDesc();
        } else {
            $company = $user->company;
            $all_sales = $company->agents;
            // dd($agents);
            // $agents = Agent::where('company_id', $company->id)->orderBy('id', 'desc')->get();
        }
        return view('dashboard.sales.index', compact('all_sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agents = Agent::all();
        return view('dashboard.sales.create', compact('agents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $upload_dir = public_path() . '/uploads/avatars/';
            $filename = uniqid() . $avatar->getClientOriginalName();
            $avatar->move($upload_dir, $filename);
        } else {
            $filename = '';
        }

        $sales_user =  User::create([
            'name'=>$request->name,
            'username'=>$request->username,
            'avatar'=>$filename,
            'password'=>bcrypt($request->password)
        ]);

        $sales_user->assignRole('sales');

        Sales::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'user_id'=>$sales_user->id,
            'agent_id'=>$request->agent_id
        ]);

        return redirect()->route('sales.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sales $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sales = Sales::find($id);
        $agents = Agent::all();
        return view('dashboard.sales.edit', compact('sales', 'agents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sales = Sales::find($id);
        if($request->hasFile('avatar')) {
            unlink(public_path() . '/uploads/avatars/' . $sales->avatar);
            $avatar = $request->file('avatar');
            $upload_dir = public_path() . '/uploads/avatars/';
            $filename = uniqid() . $avatar->getClientOriginalName();
            $avatar->move($upload_dir, $filename);
            $sales->update([
                'avatar'=>$filename
            ]);
        } else {
            $filename = '';
        }

        $sales->update([
            'name'=>$request->name,
            'phone'=>$request->phone
        ]);

        if($request->password) {
            $sales->user()->update([
                'password'=>bcrypt($request->password)
            ]);
        }

        return redirect()->route('sales.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sales = Sales::find($id);
        $user = $sales->user;
            if($user->avatar) {
                unlink(public_path('/uploads/avatars' . $user->avatar));
            }
        $user->delete();
        $sales->delete();

        return redirect()->route('sales.index');
    }
}
