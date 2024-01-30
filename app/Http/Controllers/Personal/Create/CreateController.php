<?php

namespace App\Http\Controllers\Personal\Create;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        return view('personal.post.create');
    }
}
