<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Category;
use App\Service\PublicateService;
use App\Tag;

class BasepublishController extends Controller
{
    public $service;

    public function __construct(PublicateService $service)
    {
        $this->service = $service;
    }
}
