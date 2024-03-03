<?php

namespace App\Imports;

use Twilio\Rest\Client;
use App\Models\Invitation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Concerns\ToModel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InvitationImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{

    public function  __construct($agent_id, $event_id)
    {
        $this->agent_id = $agent_id;
        $this->event_id = $event_id;
    }

    public function collection(Collection $rows)
    {
        $twilioSid = env('TWILIO_SID');
        $twilioToken = env('TWILIO_AUTH_TOKEN');
        $twilioWhatsAppNumber = env('TWILIO_WHATSAPP_NUMBER');
        $twilio = new Client($twilioSid, $twilioToken);
       foreach($rows as $row) {
            $invitation = Invitation::create([
                'invitation_number'=>hexdec(uniqid()),
                'phone'=>$row['phone'],
                'user_id'=>$this->agent_id,
                'event_id'=>$this->event_id,
            ]);
            $event = $invitation->event;
            $recipientNumber = "whatsapp:+2".$row['phone'];
            $message = "Hello, You are invited to attend our event";
            $link = route('invitations.show', $invitation);
            $qrcode = base64_encode(QrCode::size(200)->format('png')->generate($link));
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('dashboard.invitations.pdf', ['qrcode'=>$qrcode, 'invitation'=>$invitation, 'event'=>$event]);
            $pdf->save(public_path() . "/uploads/invitations/$invitation->invitation_number.pdf");

            $twilio->messages->create(
                $recipientNumber,
                [
                    "from" => 'whatsapp:'.$twilioWhatsAppNumber,
                    "body" => $message,
                ]
            );
        }

    }
}
