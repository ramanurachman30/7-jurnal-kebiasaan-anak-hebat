<?php

namespace App\Services\Guest;

use App\Models\Invitation;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Exception\ValidationException;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;

class GuestService
{
    public function getGuest($slugTo, $eventId)
    {
        $guest = Invitation::where([
            'wedding_id' => $eventId,
            'slug' => $slugTo
        ])->firstOrFail()->toArray();


        $logoPath = public_path('assets/frontend/image/about/img-minister.png');


        $qrCode = QrCode::create($guest['qr_code'])
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
            ->setSize(300)
            ->setMargin(50)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));


        $width = 80;
        $height = 80;

        $logo = Logo::create($logoPath)
            ->setResizeToWidth($width)
            ->setResizeToHeight($height)
            ->setPunchoutBackground(false);
        // $label = new Label(
        //     text: 'Label',
        // );
        $writer = new PngWriter();
        try {
            $result = $writer->write($qrCode, $logo);
            $imageBase64 = base64_encode($result->getString());
            $base64Image = 'data:image/png;base64,' . $imageBase64;

            $dataQR = [
                'to' => $guest['name'],
                'base64Image' => $base64Image,
            ];

            return $dataQR;
        } catch (ValidationException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
