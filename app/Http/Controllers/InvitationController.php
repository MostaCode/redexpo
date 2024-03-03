<?php

namespace App\Http\Controllers;

use App\Models\User;
use Twilio\Rest\Client;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Imports\InvitationImport;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone'=>'required|regex:/(01)[0-9]{9}/'
        ],[
            'phone.*'=>'Error!!, Please Enter Vaild Mobile Number !!'
        ]);
        $agent_id = User::where('username', $request->agent)->first()->id;
        $invitation = Invitation::create([
            'invitation_number'=>mt_rand(),
            'phone'=>$request->phone,
            'user_id'=>$agent_id,
            'event_id'=>$request->event_id,
        ]);

        $event = $invitation->event;
        $link = route('invitations.show', $invitation);
        $qrcode = base64_encode(QrCode::size(200)->format('png')->generate($link));
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('A4', 'portrait');
        $pdf->loadView('dashboard.invitations.pdf', ['qrcode'=>$qrcode, 'invitation'=>$invitation, 'event'=>$event]);
        $pdf->save(public_path() . "/uploads/invitations/$invitation->invitation_number.pdf");

        return back()->with('success', 'The Invitation Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invitation $invitation)
    {
        $link = route('invitations.show', $invitation);
        $qrcode = base64_encode(QrCode::size(200)->format('png')->generate($link));
        return view('dashboard.invitations.show', compact('invitation', 'qrcode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invitation $invitation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invitation $invitation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $invitation = Invitation::find($id);
        $invitation->delete();
        return back()->with('success', 'The invitation deleted successfully');
    }


    public function upload_invitations(Request $request) {
        Excel::import(new InvitationImport($request->agent_id, $request->event_id), request()->file('import'));
        return back()->with('success', 'Invitations Imported Successfully');
    }

    public function change_status(Request $request) {
        $invitation = Invitation::find($request->invitation_id);
        $invitation->update([
            'status'=>$request->status
        ]);
        return back();
    }

    public function send_qr_whatsapp($phone_number) {
        $invitation = Invitation::where('phone', $phone_number)->first();
        $twilioSid = env('TWILIO_SID');
        $twilioToken = env('TWILIO_AUTH_TOKEN');
        $twilioWhatsAppNumber = env('TWILIO_WHATSAPP_NUMBER');
        $recipientNumber =  "whatsapp:+2$phone_number";
        $invitation_number = $invitation->invitation_number;
        $message = "Hello, You are invited to attend our event you can download your invitation http://localhost/redexpo.bishop-solutions.com/uploads/invitations/$invitation_number.pdf";
        $twilio = new Client($twilioSid, $twilioToken);

        try {
            $twilio->messages->create(
                $recipientNumber,
                [
                    "from" => 'whatsapp:'.$twilioWhatsAppNumber,
                    "body" => $message,
                ]
            );

            return back()->with('success', 'Invitation sent successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error Invitation failed to send, try again later.');
        }

    }
}
