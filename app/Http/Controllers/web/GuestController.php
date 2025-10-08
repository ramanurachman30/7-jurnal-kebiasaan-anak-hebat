<?php

namespace App\Http\Controllers\Web;

use App\Events\Attandance;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Events;
use App\Models\GuestMessage;
use App\Services\Guest\GuestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GuestController extends Controller
{
    public function viewInvitation($slug, Request $request)
    {
        // $invitation = Events::find($eventId);
        $event = Event::with([
            'contentInvitations' => function ($query) {
                $query->with(['imageContents', 'template', 'gift.bankAccount.image']);
            }, 'eventschedule', 'sound'
        ])->where('slug', $slug)->firstOrFail()->toArray();
        $to = $request->query('to');
        $contentInvitation = $event['content_invitations'];
        $template = $contentInvitation['template'];
        $contentImage = $contentInvitation['image_contents'];
        $gift = $contentInvitation['gift'];
        $sound = $event['sound'];
        $schedule = $event['eventschedule'];
            // dd($contentImage);
        $formattedData = [
            "groom_image" => $this->formatImageUrl($contentImage[0] ?? null),
            "bride_image" => $this->formatImageUrl($contentImage[1] ?? null),
            "banner1" => $this->formatImageUrl($contentImage[2] ?? null),
            "banner2" => $this->formatImageUrl($contentImage[3] ?? null),
            "our_moment" => array_map(fn($img) => $this->formatImageUrl($img), array_slice($contentImage, 4))
        ];
        unset($event['content_invitations']);
        unset($event['schedule']);
        unset($contentInvitation['template']);
        unset($contentInvitation['image_contents']);
        unset($contentInvitation['gift']);

        $guestService = new GuestService();
        $guest = $guestService->getGuest($to, $event['id']);
        $messages = GuestMessage::where('event_id', $event['id'])->latest()->get();
        $data = [
            'event' => $event,
            'contentInvitation' => $contentInvitation,
            'contentImage' => $formattedData,
            'gift' => $gift,
            'guest' => $guest,
            'sound' => $sound,
            'schedule' => $schedule,
            'messages' => $messages
        ];

        return view('reader.' . $template['file_name'], compact('data'));
    }

    private function formatImageUrl($image)
    {
        return getImageUrl($image['file']['mimetype'] ?? null, $image['file']['compressed_name'] ?? null);
    }
    public function showScanner()
    {
        return view('web.scanner');
    }

    /**
     * Memproses QR code yang disubmit
     */
    public function processQrCode(Request $request)
    {
        $request->validate([
            'qr_code' => 'required',
        ]);

        $name = $request->qr_code;
        event(new Attandance($name));
        return redirect()->back();
    }

    /**
     * Menampilkan halaman listener untuk QR code
     */
    public function showListener()
    {
        // Ambil data QR code dari session
        $qrData = Session::get('qr_data');

        return view('web.listener', compact('qrData'));
    }

    public function storeMessage(Request $request, $slug)
    {
        $request->validate([
            'guest_name' => 'required|string|max:255',
            'message' => 'required|string',
            'event_id' => 'required|exists:events,id'
        ]);
        $message = GuestMessage::create($request->all());

        return response()->json(['message' => $message]);
    }

    public function getMessages($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $messages = GuestMessage::where('event_id', $event->id)->latest()->get();
        return response()->json($messages);
    }
}
