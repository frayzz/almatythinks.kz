<?php

namespace App\Service;

use App\Post;

class CreateService
{
    public function store($data)
    {
        try {
            \DB::beginTransaction();

            Post::firstOrCreate($data);
            \DB::commit();

        } catch (\Exception $exception) {
            \DB::rollBack();
            abort(500);
        }
    }

    public function update($data, $post)
    {
        try {
            \DB::beginTransaction();

            $post->update($data);
            \DB::commit();
        } catch (\Exception $exception) {
            \DB::rollBack();
            abort(500);
        }

        return $post;
    }
}
