<?php

namespace App\Http\Controllers;

use App\Exports\TeamMemberExport;
use App\Http\Requests\MemberRequest;
use App\Models\Team;
use App\Models\TeamMember;
use Maatwebsite\Excel\Facades\Excel;

class TeamMemberController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Team $team)
    {
        return view('team/show', [
            'team' => $team,
            'action' => 'member/create',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(MemberRequest $request)
    {
        $request->flash();

        $member = TeamMember::create($request->only([
            'team_id',
            'gender',
            'firstname',
            'lastname',
            'yearofbirth',
        ]));

        $member->save();

        $id = $member->team->id;

        return redirect("/team/$id");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamMember $teamMember)
    {
        return view('team/show', [
            'team' => $teamMember->team,
            'action' => 'member/edit',
            'teamMember' => $teamMember,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(MemberRequest $request, TeamMember $teamMember)
    {
        $request->flash();

        $teamMember->update($request->only([
            'gender',
            'firstname',
            'lastname',
            'yearofbirth',
        ]));

        $teamMember->save();

        $id = $teamMember->team->id;

        return redirect("/team/$id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(TeamMember $teamMember)
    {
        return view('team/show', [
            'team' => $teamMember->team,
            'action' => 'member/delete',
            'teamMember' => $teamMember,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeamMember $teamMember)
    {
        $id = $teamMember->team->id;
        $teamMember->delete();

        return redirect("/team/$id");
    }

    /**
     * Export all teams.
     *
     * @param string $key
     *
     * @return \Illuminate\Http\Response
     */
    public function export($key)
    {
        if ($key != env('API_KEY', 's87dno98s7dcfna7sd6bfi76b')) {
            return abort(404);
        }

        return Excel::download(new TeamMemberExport(), 'runners.xlsx');
    }
}
