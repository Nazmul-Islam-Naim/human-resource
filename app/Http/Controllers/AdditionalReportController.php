<?php

namespace App\Http\Controllers;

use App\Models\TransferStatus;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdditionalReportController extends Controller
{
    public function transferStatus(Request $request){
        if ($request->ajax()) {
            $transferStatuses = TransferStatus::with('generalInformation', 'generalInformation.joiningDesignation', 'generalInformation.district',
                                                     'generalInformation.presentDesignation', 'generalInformation.presentWorkStation',
                                                     'previousWorkstation', 'previousDesignation'
                                                     )->get();
            return DataTables::of($transferStatuses)->addIndexColumn()->make(true);
        }

        return view('employee.additionalReports.transferStatus');
    }
}
