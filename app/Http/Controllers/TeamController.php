<?php

namespace App\Http\Controllers;

use App\Exports\TeamExport;
use App\Http\Requests\TeamRequest;
use App\Models\Post;
use App\Models\Team;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TeamController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ($this->allowAccess() == false) {
            return redirect('/');
        }

        return view('team/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreTeamRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TeamRequest $request)
    {
        if ($this->allowAccess() == false) {
            return redirect('/');
        }

        $request->flash();

        $team = Team::create($request->only([
            'name',
            'gender',
            'firstname',
            'lastname',
            'street',
            'city',
            'country',
            'email',
            'phone',
            'yearofbirth',
        ]));

        $team->save();

        return redirect("/team/$team->id");
    }

    /**
     * Display the specified resource.
     *
     * @param $action
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team, $action = null, Request $request)
    {
        $posts = Post::whereNotNull('public')
            ->where('team_id', $team->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('team.show', [
            'team' => $team,
            'action' => $action,
            'url' => $request->url(),
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team, Request $request)
    {
        return view('team.show', [
            'team' => $team,
            'action' => 'team/edit',
            'url' => $request->url(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TeamRequest $request, Team $team)
    {
        $request->flash();

        $team->update($request->only([
            'name',
            'gender',
            'firstname',
            'lastname',
            'street',
            'city',
            'country',
            'email',
            'phone',
            'yearofbirth',
        ]));

        $team->save();

        return redirect("/team/$team->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function distance(Team $team)
    {
        $distance = 0;

        if ($team->results) {
            foreach ($team->results as $result) {
                $distance += $result->km;
            }
        }

        return view('team/show', [
            'team' => $team,
            'distance' => $distance,
            'action' => 'team/distance',
        ]);
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

        return Excel::download(new TeamExport(), 'teams.xlsx');
    }

    /**
     * Check if access to the site should be able now.
     */
    protected function allowAccess()
    {
        $end = config('fsl.allow-registrations');
        $end = date_create($end);
        $now = new \DateTime();

        if ($end < $now) {
            return false;
        }

        return true;
    }
}
