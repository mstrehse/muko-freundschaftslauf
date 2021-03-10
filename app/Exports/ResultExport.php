<?php

namespace App\Exports;

use App\Sponsor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMappingHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ResultExport implements FromView, WithStrictNullComparison
{

    public function view(): View
    {
        return view('result.export', [
            'results' => \App\Result::orderBy('team_id')->orderBy('name')->get()
        ]);
    }

    public function export()
    {
        return Excel::download(new ResultExport, 'result.xlsx');
    }

}
