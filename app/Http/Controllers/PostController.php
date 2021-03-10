<?php

namespace App\Http\Controllers;

use App\Team;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
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
     * @param \App\Team $team
     * @return \Illuminate\Http\Response
     */
    public function create(\App\Team $team)
    {
        // delete all old drafts
        \App\Post::where('team_id', $team->id)->whereNull('public')->delete();

        // create the draft and redirect to the edit view
        $post = new Post();
        $post->team_id = $team->id;
        $post->save();

        return redirect(route('post.edit', ['team' => $post->team, 'post' => $post]))->header("Turbolinks-Location", "/post/$post->id/edit");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param Team $team
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team, Post $post)
    {
        if($post->team->id != $team->id){
            return abort(404);
        }

        return view('team/show', [
            'team' => $post->team,
            'post' => $post,
            'action' => 'post/edit',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @param Team $team;
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\PostRequest $request, Team $team, Post $post)
    {
        if($post->team->id != $team->id){
            return abort(404);
        }

        $request->flash();

        $post->update($request->only([
            'text'
        ]));

        if($request->file('image')){
            $path = $request->file('image')->store('pictures', ['disk' => 'public']);
            $picture = new \App\Picture();
            $picture->src = $path;
            $picture->filename = $request->file('image')->getClientOriginalName();
            $picture->extension = $request->file('image')->extension();
            $picture->post_id = $post->id;
            $picture->save();
        }

        if($request->input('draft')){
            $post->public = false;
        }else{
            $post->public = true;
        }

        $post->save();
        $id = $post->team->id;

        if($request->input('draft')){
            return redirect(route('post.edit', ['team' => $team, 'post' => $post]))->header("Turbolinks-Location", "/post/$post->id/edit");
        }else{
            return redirect(route('team.show', ['team' => $team]));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Team $team;
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function delete(Team $team, Post $post){
        if($post->team->id != $team->id){
            return abort(404);
        }

        return view('team/show', [
            'team' => $post->team,
            'post' => $post,
            'action' => 'post/delete',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Team $team
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team, Post $post)
    {
        if($post->team->id != $team->id){
            return abort(404);
        }

        $post->delete();

        return redirect(route('team.show', ['team' => $team]));
    }

    /**
     * Shows gallery of all public posts
     * @return \Illuminate\Http\Response
     */
    public function gallery(){

        $posts = Post::where('public', true)->orderByDesc('created_at', 'DESC')->simplePaginate(50);

        return view('post/gallery', [
            'posts' => $posts
        ]);
    }

    /**
     * Shows gallery of all public posts
     * @param \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function report(Post $post){
        return view('post/report', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostReportRequest  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function reportSubmit(\App\Http\Requests\PostReportRequest $request, Post $post){
        $request->flash();

        \Mail::to('friederike.ebert@muko-berlin-brandenburg.de')
            ->cc('max@strehse.eu')
            ->send(new \App\Mail\ReportPost(
                $post,
                $request->input('email'),
                $request->input('reason')
            ));

        return redirect(route('post.reportSuccess'));
    }

    public function reportSuccess(){
        return view('post/report-success');
    }
}
