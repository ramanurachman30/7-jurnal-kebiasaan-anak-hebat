<?php
namespace App\Services;

use App\Models\Gift;

class GiftService
{
    public function store($data, $contentId)
    {
        foreach ($data as $key => $value) {
            Gift::create([
                'content_invitation_id' => $contentId,
                'bank_id'=>$value['bank_id'],
                'no_req'=>$value['no_req'],
                'receiver_name'=>$value['receiver_name']
            ]);
        }
    }
}
