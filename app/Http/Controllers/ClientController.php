<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Imports\ClientsImport;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if($user->hasRole('superadmin')) {
            $clients = Client::all()->sortDesc();
            $agents = Agent::all();
        } elseif($user->hasRole('agent')) {
            $agent = $user->agent->id;
            $clients = Client::where('agent_id', $agent)->orderBy('id', 'desc')->get();
            $agents = Agent::all();
        }elseif($user->hasRole('company')) {
            $company = $user->company;
            $agents = $company->agents;
            $agents_of_company = $company->agents->pluck('id');
            $clients = Client::whereIn('agent_id', $agents_of_company)->orderBy('id', 'desc')->get();
        } else {
            $agents = Agent::all();
        }
        return view('dashboard.clients.index', compact('clients', 'agents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agents = Agent::all();
        return view('dashboard.clients.create', compact('agents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Client::create([
            'phone'=>$request->phone,
            'agent_id'=>$request->agent_id
        ]);
        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        $agents = Agent::all();
        return view('dashboard.clients.edit', compact('client', 'agents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }

    public function upload_clients(Request $request) {
        Excel::import(new ClientsImport($request->agent_id), request()->file('import'));
        return back()->with('success', 'All good!');
    }
}
