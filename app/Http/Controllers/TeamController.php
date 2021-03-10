<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use App\Exports\TeamExport;
use Maatwebsite\Excel\Facades\Excel;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/');
        return view('team/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTeamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\TeamRequest $request)
    {
        return redirect('/');
        $request->flash();

        $team = \App\Team::create($request->only([
            'name',
            'gender',
            'firstname',
            'lastname',
            'street',
            'city',
            'country',
            'email',
            'phone',
            'yearofbirth'
        ]));

        $team->save();

        return redirect("/team/$team->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @param $action
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team, $action = null, Request $request)
    {
        $posts = \App\Post::whereNotNull('public')->where('team_id', $team->id)->orderBy('created_at', 'DESC')->get();

        return view('team.show', [
            'team' => $team,
            'action' => $action,
            'url' => $request->url(),
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team, Request $request)
    {
        return view('team.show', [
            'team' => $team,
            'action' => 'team/edit',
            'url' => $request->url()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TeamRequest $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\TeamRequest $request, Team $team)
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
            'yearofbirth'
        ]));

        $team->save();

        return redirect("/team/$team->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function distance(\App\Team $team){

        $distance = 0;

        if($team->results){
            foreach($team->results as $result){
                $distance += $result->km;
            }
        }

        return view('team/show', [
            'team' => $team,
            'distance' => $distance,
            'action' => 'team/distance'
        ]);
    }

    /**
     * Export all teams
     *
     * @param string $key
     * @return \Illuminate\Http\Response
     */
    public function export($key){

        if($key != env('API_KEY', 's87dno98s7dcfna7sd6bfi76b')){
            return abort(404);
        }

        return Excel::download(new TeamExport, 'teams.xlsx');
    }
}
