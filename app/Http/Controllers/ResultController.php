<?php

namespace App\Http\Controllers;

use App\Exports\ResultExport;
use App\Result;
use Maatwebsite\Excel\Facades\Excel;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(\App\Team $team)
    {
        $runners = [];

        $runners["$team->firstname $team->lastname"] = "$team->firstname $team->lastname";

        if ($team->members) {
            foreach ($team->members as $member) {
                $runners["$member->firstname $member->lastname"] = "$member->firstname $member->lastname";
            }
        }

        return view('team/show', [
            'team' => $team,
            'runners' => $runners,
            'action' => 'result/create',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\ResultRequest $request)
    {
        $request->flash();

        $result = \App\Result::create($request->only([
            'team_id',
            'name',
            'km',
        ]));

        $result->save();

        $id = $result->team->id;

        return redirect("/team/$id/distance");
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        $runners = [];
        $team = $result->team;

        $runners["$team->firstname $team->lastname"] = "$team->firstname $team->lastname";

        if ($team->members) {
            foreach ($team->members as $member) {
                $runners["$member->firstname $member->lastname"] = "$member->firstname $member->lastname";
            }
        }

        return view('team/show', [
            'team' => $result->team,
            'runners' => $runners,
            'action' => 'result/edit',
            'result' => $result,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\ResultRequest $request, Result $result)
    {
        $request->flash();

        $result->update($request->only([
            'name',
            'km',
        ]));

        $result->save();

        $id = $result->team->id;

        return redirect("/team/$id/distance");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Result $result)
    {
        return view('team/show', [
            'team' => $result->team,
            'action' => 'result/delete',
            'result' => $result,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        $id = $result->team->id;
        $result->delete();

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

        return Excel::download(new ResultExport(), 'result.xlsx');
    }
}
