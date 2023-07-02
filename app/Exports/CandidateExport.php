<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CandidateExport implements FromView
{


    protected $tableData;
    protected $filter_dates;
    protected $downloadType;
    public function __construct($tableData,$downloadType, $filter_dates){
        $this->tableData = $tableData;
        $this->downloadType = $downloadType;
        $this->filter_dates = $filter_dates;
    }

    public function view(): View {
        return view('boilerplate::candidate.download_candidate', [
            'tableData'=>$this->tableData,
            'downloadType' => $this->downloadType,
            'filter_dates' => $this->filter_dates
        ]);
    }
}
