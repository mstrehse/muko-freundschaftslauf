<?php

namespace App\Http\Controllers;

use App\Exports\SponsorExport;
use App\Http\Requests\SponsorRequest;
use App\Models\Sponsor;
use App\Models\Team;
use Maatwebsite\Excel\Facades\Excel;

class SponsorController extends Controller
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
            'action' => 'sponsor/create',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SponsorRequest $request)
    {
        $request->flash();

        $sponsor = Sponsor::create($request->only([
            'team_id',
            'name',
            'contact',
            'street',
            'city',
            'email',
            'phone',
            'infos',
            'amount',
        ]));

        $sponsor->save();

        $id = $sponsor->team->id;

        return redirect("/team/$id");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Sponsor $sponsor
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsor $sponsor)
    {
        return view('team/show', [
            'team' => $sponsor->team,
            'action' => 'sponsor/edit',
            'sponsor' => $sponsor,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Sponsor $sponsor
     *
     * @return \Illuminate\Http\Response
     */
    public function update(SponsorRequest $request, Sponsor $sponsor)
    {
        $request->flash();

        $sponsor->update($request->only([
            'name',
            'contact',
            'street',
            'city',
            'email',
            'phone',
            'infos',
            'amount',
        ]));

        $sponsor->save();

        $id = $sponsor->team->id;

        return redirect("/team/$id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Sponsor $sponsor
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Sponsor $sponsor)
    {
        return view('team/show', [
            'team' => $sponsor->team,
            'action' => 'sponsor/delete',
            'sponsor' => $sponsor,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Sponsor $sponsor
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsor $sponsor)
    {
        $id = $sponsor->team->id;
        $sponsor->delete();

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

        return Excel::download(new SponsorExport(), 'sponsors.xlsx');
    }
}
