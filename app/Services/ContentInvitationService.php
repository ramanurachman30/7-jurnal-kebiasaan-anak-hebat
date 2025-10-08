<?php

namespace App\Services;

use App\Models\ContentInvitation;

class ContentInvitationService
{
    public function store($data, $eventId)
    {
        return ContentInvitation::create([
            'template_id' => $data['template_id'],
            'title' => $data['title'],
            'daughter' => $data['daughter'],
            'bride_father' => $data['bride_father'],
            'bride_mother' => $data['bride_mother'],
            'bride_date' => $data['bride_date'],
            'son' => $data['son'],
            'groom_father' => $data['groom_father'],
            'groom_mother' => $data['groom_mother'],
            'groom_date' => $data['groom_date'],
            'forewords' => $data['foreword'],
            'wedding_id' => $eventId,
        ]);
    }
    public function update($data, $eventId)
    {
        // Ambil model yang sesuai
        $contentInvitation = ContentInvitation::where('wedding_id', $eventId)->first();

        if (!$contentInvitation) {
            return null;
        }

        // Update atribut
        $contentInvitation->fill([
            'template_id'   => $data['template_id'],
            'title'         => $data['title'],
            'daughter'      => $data['daughter'],
            'bride_father'  => $data['bride_father'],
            'bride_mother'  => $data['bride_mother'],
            'bride_date'    => $data['bride_date'],
            'son'           => $data['son'],
            'groom_father'  => $data['groom_father'],
            'groom_mother'  => $data['groom_mother'],
            'groom_date'    => $data['groom_date'],
            'forewords'     => $data['foreword'],
            'wedding_id'    => $eventId,
        ]);

        $contentInvitation->save();

        return $contentInvitation;
    }
}
