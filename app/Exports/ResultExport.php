<?php

namespace App\Exports;

use App\Models\Result;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Facades\Excel;

class ResultExport implements FromView, WithStrictNullComparison
{
    public function view(): View
    {
        return view('result.export', [
            'results' => Result::orderBy('team_id')->orderBy('name')->get(),
        ]);
    }

    public function export()
    {
        return Excel::download(new ResultExport(), 'result.xlsx');
    }
}
