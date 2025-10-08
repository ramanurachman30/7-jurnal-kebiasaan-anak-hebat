<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\HeadTitles;
use App\Models\LinkCollections;
use App\Models\Links;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;


class HomeController extends Controller
{

    public function index()
    {
        $defaultNameSync = [
            'id' => 'Sync Digital Indonesia',
            'en' => 'Sync Digital Indonesia',
        ];
        generateSEO([
            'title' => $defaultNameSync[lang()] . ' - ' . __('Home Page'),
            'description' => $defaultNameSync[lang()] . ' - ' . __('Home Page'),
        ]);

        $footer = $this->footer();
        $linkPir = $this->getLinks("pir");
        $linkOss = $this->getLinks("oss");
        $dataOss = [];
        $sliderBanners = [];
        $homeBanner = [];
        $sectionTwo = $this->sectionTwo();
        $dataAnnouncements = [];
        $floatingBanner = [];

        $cachedPage = view('web.index', compact(
            'footer',
            'linkPir',
            'linkOss',
            'dataOss',
            'sliderBanners',
            'dataAnnouncements',
            'sectionTwo',
            'homeBanner',
            'floatingBanner'
        ))->render();
        return $cachedPage;
    }

    public function footer()
    {
        $data = [
            'social_media' => $this->getSocialMedia(),
            'publications' => [],
            'links' => $this->getLinks(),
            'linkFooters' => $this->getLinkFooter(),
            'linkFootersServices' => $this->getLinkFooterServices(),
            'dataAddress' => [],
        ];

        return $data;
    }

    public function getSocialMedia()
    {
        // $social_media = DB::table('links')->where('type', 'social_media')->get();
        $type = 'social_media';

        $social_media = LinkCollections::with('image')
            ->where('type', $type)
            ->orderByDesc('ordering')
            ->get()
            ->toArray();
        return $social_media;
    }

    public function getLinks($name = "")
    {
        // $link = DB::table('links')->where(['type' => 'web', 'deleted_at' => NULL])->get();
        $param = [
            'type' => 'web'
        ];
        if (!empty($name)) $param['name'] = $name;
        $link = Links::where($param)
            ->get()
            ->toArray();

        return $link;
    }

    public function getLinkFooter()
    {
        $linkFooters = Links::whereIn(
            'id',
            [9, 10, 11, 12, 18]
        )
            ->get()
            ->toArray();

        return $linkFooters;
    }

    public function getLinkFooterServices()
    {
        $linkFootersServices = Links::whereIn(
            'id',
            [
                '14',
                '15',
                '16',
            ]
        )
            ->get()
            ->toArray();

        return $linkFootersServices;
    }

    public function sectionTwo()
    {
        $category = [
            'id' => 'Halaman Home Bagian Ke-2',
            'en' => 'Home Section 2',
        ];
        $dataSectionTwo = HeadTitles::where([
            ['content_type', lang()],
            ['category', $category[lang()]]
        ])
            ->get()
            ->toArray();
        return $dataSectionTwo;
    }

    public function search(Request $request)
    {
        generateSEO([
            'title' => 'SYNC - ' . __('Search Page'),
            'description' => 'Search Result',
        ]);
        if (!$request->get('q')) return redirect('error/404');
        $search = $request->get('q');

        $model = app("App\Models\\Publications");
        $fields = $model->getFields();
        $model = $model->with(['file', 'document'])->where(function ($model) use ($fields, $search) {
            $keywords = str_replace(' ', '|', $search);
            $src = strtolower($keywords);
            $model->whereRaw("lower(title) ~ ?", [$src]);
            // $model->whereRaw("lower(title) ~ lower('$keywords')");
        });
        $model = $model->paginate(10);

        $key = explode(' ', $search);
        $regex = [];
        for ($i = 0; $i < count($key); $i++) {
            $regex[$key[$i]] = '<span class="text-green">' . $key[$i] . '</span>';
            $regex[strtolower($key[$i])] = '<span class="text-green">' . strtolower($key[$i]) . '</span>';
            $regex[strtoupper($key[$i])] = '<span class="text-green">' . strtoupper($key[$i]) . '</span>';
            $regex[ucfirst($key[$i])] = '<span class="text-green">' . ucfirst($key[$i]) . '</span>';
            $regex[ucwords($key[$i])] = '<span class="text-green">' . ucwords($key[$i]) . '</span>';
        }

        $footer = $this->footer();
        return view('web.search-result.index', compact('footer', 'model', 'regex'));
    }
    public function comproSlicing()
    {
        return view('web.pages.home');
    }

    public function aboutUsPage(){
        return view('web.pages.aboutus');
    }

    public function products(){
        return view('web.pages.products');
    }

    public function contactus(){
        return view('web.pages.contactus');
    }

    public function newsNEvents(){
        return view('web.pages.newsNEvents');
    }

    public function detailEvents(){
        return view('web.pages.detailEvents');
    }

    public function detailNews(){
        return view('web.pages.detailNews');
    }
}
