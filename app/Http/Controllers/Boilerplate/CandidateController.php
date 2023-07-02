<?php

namespace App\Http\Controllers\Boilerplate;

use App\Exports\CandidateExport;
use App\Http\Controllers\Controller;
use App\Models\Boilerplate\Candidate;
use App\Models\Boilerplate\Institute;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\PDF as PDF;
use Maatwebsite\Excel\Facades\Excel;


class CandidateController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('boilerplate::candidate.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institutesList = Institute::where('status', 1)->get();
        return view('boilerplate::candidate.create', [
            'institutesList' => $institutesList
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $messages = [
            'institute_id.required' => 'Institute is Required',
            'camp.required' => 'Camp is Required',
            'activity.required' => 'Activity is Required',
            'sr_no.required' => 'Serial Number is Required',
            'regiment_no.required' => 'Cegiment Number is Required',
            'name.required' => 'Name is Required',
        ];
        $this->validate($request, [
            'institute_id'  => 'required',
            'camp' => 'required',
            'activity' => 'required',
            'sr_no' => 'required',
            'regiment_no' => 'required',
            'name' => 'required',
        ], $messages);

        $input = $request->all();
        Candidate::create($input);
        return redirect()->route('boilerplate.candidate.index')
            ->with('growl', [__('boilerplate::candidate.successadd'), 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $institute = Candidate::find($id);
        return response()->json(['success' => $institute->delete() ?? false]);
    }

    protected function button(string $route, string $class, string $icon): string
    {
        $str = '<a href="%s" class="btn btn-sm btn-%s"><i class="fa fa-fw fa-%s"></i></a>';

        return sprintf($str, $route, $class, $icon);
    }
    public function datatable(Request $request)
    {
        $candidate = Candidate::with('institute');
        // dd($candidate);
        return DataTables::eloquent($candidate)
            ->rawColumns(['actions'])
            ->editColumn('actions', function ($candidate) {
                $b = $this->button(route('boilerplate.candidate.destroy', $candidate->id), 'danger destroy', 'trash');
                return $b;
            })->make(true);
    }
    public function FilterCandidateDatatable(Request $request)
    {
        try {
            $input = $request->all();
            $candidate = Candidate::with('institute');
            if (isset($input['filter_start_date']) && !empty($input['filter_start_date'])) {
                $input['filter_start_date'] = date('Y-m-d', strtotime($input['filter_start_date']));
                $candidate = $candidate->whereDate('created_at', ">=",  $input['filter_start_date']);
            }
            if (isset($input['filter_end_date']) && !empty($input['filter_end_date'])) {
                $input['filter_end_date'] = date('Y-m-d', strtotime($input['filter_end_date']));
                $candidate = $candidate->whereDate('created_at', "<=",  $input['filter_end_date']);
            }
            return DataTables::eloquent($candidate)
                ->rawColumns(['actions'])
                ->editColumn('actions', function ($candidate) {
                    $b = $this->button(route('boilerplate.candidate.destroy', $candidate->id), 'danger destroy', 'trash');
                    return $b;
                })
                ->make(true);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function DownloadCandidateData(Request $request)
    {
        try {

            $tableData = $request->input('tableData', []);
            $filterStartDate = $request->input('filter_start_date');
            $filterEndDate = $request->input('filter_end_date');
            $downloadType = $request->input('downloadType', 'excel');
            $filterDates = [
                'start_date' => $filterStartDate,
                'end_date' => $filterEndDate
            ];
            if ($downloadType === 'excel') {
                $excel =  Excel::download(
                    new CandidateExport(
                        $tableData,
                        $downloadType,
                        $filterDates
                    ),
                    'candidate-list.xlsx'
                );
                // dd($excel);
                return $excel;
            } elseif ($downloadType === 'pdf') {
                $pdf = app('dompdf.wrapper');
                $pdf = $pdf->loadView('boilerplate::candidate.download_candidate', [
                    'tableData' => $tableData,
                    'downloadType' => $downloadType,
                    'filter_dates' => $filterDates
                ]);
                $pdf->setOptions(['orientation' => 'landscape']);

                return $pdf->download('candidate-list.pdf');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function create_candidate(Request $request)
    {
        $messages = [
            'institute_id.required' => 'Institute is Required',
            'camp.required' => 'Camp is Required',
            'activity.required' => 'Activity is Required',
            'sr_no.required' => 'Serial Number is Required',
            'regiment_no.required' => 'Cegiment Number is Required',
            'name.required' => 'Name is Required',
        ];
        $this->validate($request, [
            'institute_id'  => 'required',
            'camp' => 'required',
            'activity' => 'required',
            'sr_no' => 'required',
            'regiment_no' => 'required',
            'name' => 'required',
        ], $messages);

        $input = $request->all();
        Candidate::create($input);

        return redirect()->back()->with('growl', [__('boilerplate::candidate.successadd'), 'success']);
    }

    public function getCandidateListWithInstitutes()
    {
        $candidate = Candidate::with('institute')->get();
        return $this->sendResponse($candidate, "Candidate List Fatched Successfully");
    }

    public function AddCandidateAPI(Request $request) {
        $messages = [
            'institute_id.required' => 'Institute is Required',
            'camp.required' => 'Camp is Required',
            'activity.required' => 'Activity is Required',
            'sr_no.required' => 'Serial Number is Required',
            'regiment_no.required' => 'Cegiment Number is Required',
            'name.required' => 'Name is Required',
        ];
        $this->validate($request, [
            'institute_id'  => 'required',
            'camp' => 'required',
            'activity' => 'required',
            'sr_no' => 'required',
            'regiment_no' => 'required',
            'name' => 'required',
        ], $messages);

        $input = $request->all();
        $add_candidate = Candidate::create($input);
        if(is_null($add_candidate)) {
            return $this->sendError("having trouble while adding candidate.");
        }
        return $this->sendResponse([], "Candidate added successfully");
    }
}
