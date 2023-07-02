<?php

namespace App\Http\Controllers\Boilerplate;

use App\Http\Controllers\Controller;
use App\Models\Boilerplate\Institute;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InstituteController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('boilerplate::institutes.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('boilerplate::institutes.create');

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
        // dd($request->toArray());
        $messages = [
            'institute_name.required' => 'Institute Name is Required',
        ];
        $this->validate($request, [
            'institute_name'  => 'required',
        ], $messages);

        $input = $request->all();
        Institute::create($input);
        return redirect()->route('boilerplate.institutes.index')
            ->with('growl', [__('boilerplate::institutes.successadd'), 'success']);

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
        $institute = Institute::find($id);
        return response()->json(['success' => $institute->delete() ?? false]);

    }

    protected function button(string $route, string $class, string $icon): string
    {
        $str = '<a href="%s" class="btn btn-sm btn-%s"><i class="fa fa-fw fa-%s"></i></a>';

        return sprintf($str, $route, $class, $icon);
    }
    public function datatable(Request $request)
    {
        $instite = Institute::query('*');

        return DataTables::eloquent($instite)
            ->rawColumns(['actions'])
            ->editColumn('actions', function ($institute) {
                $b = $this->button(route('boilerplate.institutes.destroy', $institute->id), 'danger destroy', 'trash');
                return $b;

            })->make(true);
    }

    public function getInstituteList() {
        $institutesList= Institute::where('status',1)->get();
         return $this->sendResponse($institutesList, "Institute List Fatched Successfully");
     }

     public function AddInstituteAPI(Request $request) {
        $messages = [
            'institute_name.required' => 'Institute Name is Required',
        ];
        $this->validate($request, [
            'institute_name'  => 'required',
        ], $messages);

        $input = $request->all();
        $add_institute = Institute::create($input);
        if(is_null($add_institute)){
            return $this->sendError("Having trouble while adding institute.");
        }
        return $this->sendResponse([], "Institue added successfully.");
     }
}

