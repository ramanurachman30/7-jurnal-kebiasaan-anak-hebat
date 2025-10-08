<?php
namespace App\Services;
use Illuminate\Support\Facades\Hash;
use App\Models\Invitation;

class InvitationService
{
    public function store($data, $eventId)
    {
        foreach ($data as $key => $value) {
            $qrString = $value['nama'] . '|' . $value['no_telpon'] . '|' . now();
            Invitation::create([
                'wedding_id'=> $eventId,
                'name' => $value['nama'],
                'phone'=>$value['no_telpon'],
                'address' => $value['alamat'],
                'qr_code' => Hash::make($qrString),
            ]);
        }
    }
}
