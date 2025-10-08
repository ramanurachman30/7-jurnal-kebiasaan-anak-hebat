<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LocalGovernments;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function getProvince($keyword = '')
    {
        $provinces = LocalGovernments::with('province')->whereHas('getProvince', function ($query) use ($keyword) {
            if (empty($keyword)) return $query;
            return $query->where('title', 'LIKE', '%' . $keyword . '%')->orWhere('slug', 'LIKE', '%' . $keyword . '%');
        })->get();
        $result = $provinces->toArray();

        return response($result);
    }
}