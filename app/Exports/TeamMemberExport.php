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

class TeamMemberExport implements FromView, WithStrictNullComparison
{

    public function view(): View
    {
        return view('member.export', [
            'teams' => \App\Team::all()
        ]);
    }

    public function export()
    {
        return Excel::download(new TeamMemberExport, 'members.xlsx');
    }

}
