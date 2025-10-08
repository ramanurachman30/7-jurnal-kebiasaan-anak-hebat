<?php

use App\Models\InvestmentOutlooks;
use Illuminate\Support\Facades\App;

function lang()
{
    return App::getLocale();
}

function limitString($string, $limit = 4)
{
    if (!is_string($string)) return $string;
    if (str_word_count($string, 0) > $limit) {
        $words = str_word_count($string, 2);
        $pos   = array_keys($words);
        $string  = '<span class="less">' . substr($string, 0, $pos[$limit]) . '... <a href="#">more</a></span><span class="more d-none">' . $string . '... <a href="#">less</a></span>';
    }
    return $string;
}

function limitText($string, $limit = 3)
{
    if (!is_string($string)) return $string;
    if (str_word_count($string, 0) > $limit) {
        $words = str_word_count($string, 2);
        $pos   = array_keys($words);
        $string  = '<span class="less">' . substr($string, 0, $pos[$limit]) . '...';
    }
    return $string;
}

function getDay($lang, $date)
{
    $d = date('N', strtotime($date));

    $theDays = [
        'id' => [
            'days' => [
                '1' => 'Senin',
                '2' => 'Selasa',
                '3' => 'Rabu',
                '4' => 'Kamis',
                '5' => "Jum'at",
                '6' => 'Sabtu',
                '7' => 'Minggu',
            ]
        ],
        'en' => [
            'days' => [
                '1' => 'Monday',
                '2' => 'Tuesday',
                '3' => 'Wednesday',
                '4' => 'Thrusday',
                '5' => 'Friday',
                '6' => 'Saturday',
                '7' => 'Sunday',
            ],
        ],
    ];

    $result = $theDays[$lang]['days'][$d];
    return $result;
}

function getFormatDate($lang, $date)
{
    $day = date('d', strtotime($date));
    $month = date('m', strtotime($date));
    $year = date('Y', strtotime($date));

    $months = [
        'id' => [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ],
        'en' => [
            '01' => 'January',
            '02' => 'February',
            '03' => 'March',
            '04' => 'April',
            '05' => 'May',
            '06' => 'June',
            '07' => 'July',
            '08' => 'August',
            '09' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December',
        ],
    ];

    $result = $day . ' ' . $months[$lang][$month] . ' ' . $year;
    return $result;
}

function getFullDate($lang, $date)
{
    $d = date('N', strtotime($date));
    $day = date('d', strtotime($date));
    $month = date('m', strtotime($date));
    $year = date('Y', strtotime($date));

    $months = [
        'id' => [
            'months' => [
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember',
            ],
            'days' => [
                '1' => 'Senin',
                '2' => 'Selasa',
                '3' => 'Rabu',
                '4' => 'Kamis',
                '5' => 'Jumat',
                '6' => 'Sabtu',
                '7' => 'Minggu',
            ]
        ],
        'en' => [
            'months' => [
                '01' => 'January',
                '02' => 'February',
                '03' => 'March',
                '04' => 'April',
                '05' => 'May',
                '06' => 'June',
                '07' => 'July',
                '08' => 'August',
                '09' => 'September',
                '10' => 'October',
                '11' => 'November',
                '12' => 'December',
            ],
            'days' => [
                '1' => 'Monday',
                '2' => 'Tuesday',
                '3' => 'Wednesday',
                '4' => 'Thrusday',
                '5' => 'Friday',
                '6' => 'Saturday',
                '7' => 'Sunday',
            ],
        ],
    ];

    $result = $months[$lang]['days'][$d] . ', ' . $day . ' ' . $months[$lang]['months'][$month] . ' ' . $year;
    return $result;
}

function getShortMonth($lang, $date)
{
    $day = date('d', strtotime($date));
    $month = date('m', strtotime($date));
    $year = date('Y', strtotime($date));

    $months = [
        'id' => [
            '01' => 'Jan',
            '02' => 'Feb',
            '03' => 'Mar',
            '04' => 'Apr',
            '05' => 'Mei',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Agu',
            '09' => 'Sep',
            '10' => 'Okt',
            '11' => 'Nov',
            '12' => 'Des',
        ],
        'en' => [
            '01' => 'Jan',
            '02' => 'Feb',
            '03' => 'Mar',
            '04' => 'Apr',
            '05' => 'May',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Aug',
            '09' => 'Sep',
            '10' => 'Oct',
            '11' => 'Nov',
            '12' => 'Dec',
        ],
    ];

    $result = $day . ' ' . $months[$lang][$month] . ' ' . $year;
    return $result;
}

function shareLink($key)
{
    $link = [
        'linkedin' => 'https://www.linkedin.com/sharing/share-offsite/?url=' . url()->current(),
        'twitter' => 'https://twitter.com/intent/tweet?text=' . url()->current(),
        'whatsapp' => 'https://api.whatsapp.com/send?text=' . url()->current(),
        'facebook' => 'https://www.facebook.com/sharer.php?u=' . url()->current(),
    ];

    return $link[$key];
}

function getImageDefault()
{
    $imageDefault = asset('assets/frontend/image/logo/logo-id.png');
    return $imageDefault;
}

function getImageUrl($ext, $filename)
{
    $extension = explode('/', $ext);
    $path = 'storage/image/origin/' . $extension[1] . '/' . $filename;
    // $check = public_path($path);

    // if (!file_exists($check)) return '#';
    return asset($path);
}

function getImageCompressUrl($ext, $filename)
{
    $extension = explode('/', $ext);
    $path = 'storage/image/compress/' . $extension[1] . '/' . $filename;
    return asset($path);
}

function getImageCompressUrlOther($file, $type)
{
    $decode = json_decode($file, true);

    switch ($type) {
        case 'square':
            $image = $decode['pathSquare'];
            return $image;
            break;

        default:
            $image = $decode['pathLandscape'];
            return $image;
            break;
    }
}

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

function humanizeSegmentName($value)
{
    return ucwords(trim(preg_replace('/(?<!^)([A-Z])/', ' $1', $value)));
}