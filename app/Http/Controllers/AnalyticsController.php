<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Analytics\Period;
use Facades\Spatie\Analytics\Analytics;

class AnalyticsController extends Controller
{
    public function index()
    {
        $analyticsData = Analytics::performQuery(
            Period::years(1),
            'ga:sessions',
            [
                'metrics' => 'ga:sessions, ga:pageviews',
                'dimensions' => 'ga:yearMonth'
            ]
        );

        $sessions = [];
        $pageviews = [];
        $dates = [];

        foreach ($analyticsData as $values) {
            array_push($dates, $values[0]);
            array_push($sessions, $values[1]);
            array_push($pageviews, $values[2]);
        }
        $dates = collect($dates);
        $pageviews = collect($pageviews);
        $sessions = collect($sessions);

        return view('admin.analytics', compact('dates', 'pageviews', 'sessions'));
    }
}
