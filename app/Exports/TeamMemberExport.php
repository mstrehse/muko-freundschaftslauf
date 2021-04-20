<?php

namespace App\Exports;

use App\Models\Team;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Facades\Excel;

class TeamMemberExport implements FromView, WithStrictNullComparison
{
    public function view(): View
    {
        return view('member.export', [
            'teams' => Team::all(),
        ]);
    }

    public function export()
    {
        return Excel::download(new TeamMemberExport(), 'members.xlsx');
    }
}
