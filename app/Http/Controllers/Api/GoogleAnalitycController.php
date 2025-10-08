<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;
use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;

use Illuminate\Http\Request;

class GoogleAnalitycController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.dashboard.google-analytic');
    }

    public function topRefferrersIndex(Request $request)
    {
        return view('backend.dashboard.top-referrers');
    }

    public function mostVisitedPageIndex(Request $request)
    {
        return view('backend.dashboard.most-visited-pages');
    }

    public function report(Request $request)
    {
        $offset = $request->get('start') ? $request->get('start') : 0;
        $maxLimit = $request->get('length') ? $request->get('length') : 10;
        $search = $request->get('search');
        $orderBy = $request->get('order');

        // $allData = \Analytics::fetchVisitorsAndPageViews(Period::months(6));
        // dd($allData);
        $fields = [
            'pageTitle',
            'date',
            'activeUsers',
            'screenPageViews',
        ];

        $collection = \Analytics::fetchVisitorsAndPageViewsByDate(Period::months(10), 10000);

        $total = $collection->count();

        $collection = $collection->filter(function ($data, $key) use ($search) {
            if (empty($search)) return $data;
            return false !== stristr($data['pageTitle'], $search);
        });

        $filtered = $collection->count();
        // sort
        $column = $fields[$orderBy[0]['column']];
        $sorting = [fn (array $a, array $b) => $a[$column] <=> $b[$column]];
        if ($orderBy[0]['dir'] == 'desc') $sorting = [fn (array $a, array $b) => $b[$column] <=> $a[$column]];
        $collection = $collection->sortBy($sorting);

        $collection = $collection->skip($offset);
        $collection = $collection->take($maxLimit);

        $dataTable = [];
        foreach ($collection as $key => $value) {
            $value['date'] = date('d M Y', strtotime($value['date']));
            $dataTable[] = $value;
        }

        $draw = 1;
        if (!empty($request->get('draw'))) {
            $draw = $request->get('draw');
        }

        $data = [
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $filtered,
            'data' => $dataTable
        ];
        return response($data);
    }

    public function topRefferrers(Request $request)
    {
        $offset = $request->get('start') ? $request->get('start') : 0;
        $maxLimit = $request->get('length') ? $request->get('length') : 10;
        $search = $request->get('search');
        $orderBy = $request->get('order');

        $fields = [
            'pageReferrer',
            'screenPageViews',
        ];

        $collection = \Analytics::fetchTopReferrers(Period::months(10), 10000);

        $total = $collection->count();

        $collection = $collection->filter(function ($data, $key) use ($search) {
            if (empty($search)) return $data;
            return false !== stristr($data['pageReferrer'], $search);
        });

        $filtered = $collection->count();
        // sort
        $column = $fields[$orderBy[0]['column']];
        $sorting = [fn (array $a, array $b) => $a[$column] <=> $b[$column]];
        if ($orderBy[0]['dir'] == 'desc') $sorting = [fn (array $a, array $b) => $b[$column] <=> $a[$column]];
        $collection = $collection->sortBy($sorting);

        $collection = $collection->skip($offset);
        $collection = $collection->take($maxLimit);

        $dataTable = [];
        foreach ($collection as $key => $value) {
            $dataTable[] = $value;
        }

        $draw = 1;
        if (!empty($request->get('draw'))) {
            $draw = $request->get('draw');
        }

        $data = [
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $filtered,
            'data' => $dataTable
        ];
        return response($data);
    }

    public function mostVistedPages(Request $request)
    {
        $offset = $request->get('start') ? $request->get('start') : 0;
        $maxLimit = $request->get('length') ? $request->get('length') : 10;
        $search = $request->get('search');
        $orderBy = $request->get('order');

        $fields = [
            'fullPageUrl',
            'pageTitle',
            'screenPageViews',
        ];

        $collection = \Analytics::fetchMostVisitedPages(Period::months(10), 10000);

        $total = $collection->count();

        $collection = $collection->filter(function ($data, $key) use ($search) {
            if (empty($search)) return $data;
            return false !== stristr($data['fullPageUrl'], $search);
        });

        $filtered = $collection->count();
        // sort
        $column = $fields[$orderBy[0]['column']];
        $sorting = [fn (array $a, array $b) => $a[$column] <=> $b[$column]];
        if ($orderBy[0]['dir'] == 'desc') $sorting = [fn (array $a, array $b) => $b[$column] <=> $a[$column]];
        $collection = $collection->sortBy($sorting);

        $collection = $collection->skip($offset);
        $collection = $collection->take($maxLimit);

        $dataTable = [];
        foreach ($collection as $key => $value) {
            $dataTable[] = $value;
        }

        $draw = 1;
        if (!empty($request->get('draw'))) {
            $draw = $request->get('draw');
        }

        $data = [
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $filtered,
            'data' => $dataTable
        ];
        return response($data);
    }
}
