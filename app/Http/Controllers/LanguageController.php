<?php

namespace App\Http\Controllers;

use App\Models\Languages;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

class LanguageController extends Controller
{

    public function switchLang($lang)
    {
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('applocale', $lang);
        }

        return redirect()->back()->with('success', __('Language Changed'));
    }

    public function chageLanguage($lang)
    {
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('applocale', $lang);
        }

        $url = URL::to("$lang/home");
        return redirect($url)->with('success', __('Language Changed'));
    }

    // public function generateLanguage(Request $request)
    // {
    //     try {
    //         $code = $request->get('country_code');
    //         $collection = Languages::where('country_code', $code)->get()->toArray();
    //         if (count($collection) <= 0) return back()->withErrors(__('Collection is empty'));

    //         $data = [];
    //         foreach ($collection as $items) {
    //             $data[$items['key']] = $items['translate'];
    //         }

    //         $file = base_path() . "/lang/" . $code . ".json";
    //         if (file_exists($file)) {
    //             unlink($file);
    //         }

    //         $data = json_encode($data);
    //         File::put($file, $data);

    //         return back()->with('success', __('Language generated'));
    //     } catch (Exception $e) {
    //         return back()->withErrors(__('Failed to generate language'));
    //     }
    // }
}