<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Event;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $events = Event::all()->sortDesc();
        if($user->hasRole('superadmin')) {
            $companies_count = Company::all()->count();
            $agents_count = Agent::all()->count();
            $clients_count = Client::all()->count();
            $events_count = Event::all()->count();
        } elseif($user->hasRole('agent')) {
            $agent = $user->agent->id;
            $clients_count = Client::where('agent_id', $agent)->count();
            $companies_count = Company::all()->count();
            $agents_count = Agent::all()->count();
        }elseif($user->hasRole('company')) {
            $company = $user->company;
            $agents_count = Agent::where('company_id', $company->id)->count();
            $agents_of_company = $company->agents->pluck('id');
            $clients_count = Client::whereIn('agent_id', $agents_of_company)->count();
            $companies_count = Company::all()->count();
        }
        return view('dashboard.home', compact('companies_count', 'agents_count', 'clients_count', 'events_count', 'events'));
    }

}
