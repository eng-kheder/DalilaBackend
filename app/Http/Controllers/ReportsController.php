<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use App\Http\Requests\ReportRequest;


class ReportsController extends Controller
{

    function create(ReportRequest $req)  // add report
    {
        $report = Reports::create([
            'user_id'=> $req->user_id,
            'guide_id'=> $req->guide_id,
            'agency_id'=> $req->agency_id,
            'description'=> $req->description,
        ]);
        return response()->json(['message' => "created successfully" ], 200);
    }

}
