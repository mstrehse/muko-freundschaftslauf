<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostReportRequest;
use App\Http\Requests\PostRequest;
use App\Mail\ReportPost;
use App\Models\Picture;
use App\Models\Post;
use App\Models\Team;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Team $team)
    {
        // delete all old drafts
        Post::where('team_id', $team->id)->whereNull('public')->delete();

        // create the draft and redirect to the edit view
        $post = new Post();
        $post->team_id = $team->id;
        $post->save();

        return redirect(route('post.edit', ['team' => $post->team, 'post' => $post]))->header('Turbolinks-Location', "/post/$post->id/edit");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team, Post $post)
    {
        if ($post->team->id != $team->id) {
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
     * @param Team $team;
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Team $team, Post $post)
    {
        if ($post->team->id != $team->id) {
            return abort(404);
        }

        $request->flash();

        $post->update($request->only([
            'text',
        ]));

        if ($request->file('image')) {
            $path = $request->file('image')->store('pictures', ['disk' => 'public']);
            $picture = new Picture();
            $picture->src = $path;
            $picture->filename = $request->file('image')->getClientOriginalName();
            $picture->extension = $request->file('image')->extension();
            $picture->post_id = $post->id;
            $picture->save();
        }

        if ($request->input('draft')) {
            $post->public = false;
        } else {
            $post->public = true;
        }

        $post->save();

        if ($request->input('draft')) {
            return redirect(route('post.edit', ['team' => $team, 'post' => $post]))->header('Turbolinks-Location', "/post/$post->id/edit");
        } else {
            return redirect(route('team.show', ['team' => $team]));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Team $team;
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Team $team, Post $post)
    {
        if ($post->team->id != $team->id) {
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
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team, Post $post)
    {
        if ($post->team->id != $team->id) {
            return abort(404);
        }

        $post->delete();

        return redirect(route('team.show', ['team' => $team]));
    }

    /**
     * Shows gallery of all public posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function gallery()
    {
        $posts = Post::where('public', true)->orderByDesc('created_at', 'DESC')->simplePaginate(50);

        return view('post/gallery', [
            'posts' => $posts,
        ]);
    }

    /**
     * Shows gallery of all public posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function report(Post $post)
    {
        return view('post/report', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function reportSubmit(PostReportRequest $request, Post $post)
    {
        $request->flash();

        Mail::to('friederike.ebert@muko-berlin-brandenburg.de')
            ->cc('max@strehse.eu')
            ->send(new ReportPost(
                $post,
                $request->input('email'),
                $request->input('reason')
            ));

        return redirect(route('post.reportSuccess'));
    }

    public function reportSuccess()
    {
        return view('post/report-success');
    }
}
