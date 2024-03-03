<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agent;
use App\Models\Company;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if($user->hasRole('superadmin')) {
            $agents = Agent::all()->sortDesc();
        } else {
            $company = $user->company;
            $agents = $company->agents;
            // dd($agents);
            // $agents = Agent::where('company_id', $company->id)->orderBy('id', 'desc')->get();
        }
        return view('dashboard.agents.index', compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        return view('dashboard.agents.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $upload_dir = public_path() . '/uploads';
            $filename = uniqid() . $logo->getClientOriginalName();
            $logo->move($upload_dir, $filename);
        } else {
            $filename = '';
        }

        $agent_user =  User::create([
            'name'=>$request->name,
            'username'=>$request->username,
            'avatar'=>$filename,
            'password'=>bcrypt($request->password)
        ]);

        $agent_user->assignRole('agent');

        Agent::create([
            'name'=>$request->name,
            'logo'=>$filename,
            'about'=>$request->about,
            'phone'=>$request->phone,
            'user_id'=>$agent_user->id,
            'company_id'=>$request->company_id
        ]);

        return redirect()->route('agents.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agent $agent)
    {
        return view('dashboard.agents.edit', compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agent $agent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agent $agent)
    {
        //
    }
}
