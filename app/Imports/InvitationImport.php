<?php

namespace App\Imports;

use App\Models\Invitation;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InvitationImport implements ToModel, WithHeadingRow
{
    public function __construct(
        protected string $eventId
    ) {}
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $qrCode = Str::uuid()->toString();

        return new Invitation([
            'wedding_id' => $this->eventId,
            'name'       => $row['nama'],
            'phone'      => $row['no_telpon'],
            'address'    => $row['alamat'] ?? null,
            'qr_code'    => $qrCode,
        ]);
    }
}
