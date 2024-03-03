<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Event;
use App\Models\Invitation;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all()->sortDesc();
        return view('dashboard.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $delimiter = '-';
        $str = $request->title;
        $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));

        if($request->hasFile('thumbnail')) {
            $thumbnail_file = $request->file('thumbnail');
            $upload_dir = public_path() . '/uploads/events';
            $thumbnail = uniqid() . $thumbnail_file->getClientOriginalName();
            $thumbnail_file->move($upload_dir, $thumbnail);
        } else {
            $thumbnail = '';
        }
        Event::create([
            'title'=>$request->title,
            'slug'=>$slug,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'location'=>$request->location,
            'description'=>$request->description,
            'thumbnail'=>$thumbnail,
        ]);

        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $invitations = Invitation::where('event_id', $event->id)->orderBy('id', 'desc')->get();
        return view('dashboard.events.show', compact('event', 'invitations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('dashboard.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {

        $delimiter = '-';
        $str = $request->title;
        $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));

        if($request->hasFile('thumbnail')) {
            unlink(public_path() . "uploads/events/$event->thumbnail");
            $thumbnail_file = $request->file('thumbnail');
            $upload_dir = public_path() . '/uploads/events';
            $thumbnail = uniqid() . $thumbnail_file->getClientOriginalName();
            $thumbnail_file->move($upload_dir, $thumbnail);
            $event->update([
                'thumbnail'=>$thumbnail
            ]);
        }

        $event->update([
            'title'=>$request->title,
            'slug'=>$slug,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'location'=>$request->location,
            'description'=>$request->description,
        ]);

        return redirect()->route('events.show', $event->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();
        if($event->thumbnail) {
            unlink(public_path() . "/uploads/events/$event->thumbnail");
        }
        return back();
    }

    public function event_register($slug) {
        $event = Event::where('slug', $slug)->firstOrFail();
        return view('front.register_event', compact('event'));
    }
}
