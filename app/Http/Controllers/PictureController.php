<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use App\Models\Post;

class PictureController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Picture $pictures
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Picture $picture, Post $post)
    {
        if ($picture->post_id != $post->id) {
            return abort(404);
        }

        $picture->delete();

        return redirect(route('post.edit', ['team' => $post->team, 'post' => $post]));
    }
}
