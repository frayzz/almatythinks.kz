<?php

namespace App\Http\Controllers\Personal\Create;

use App\Http\Controllers\Controller;
use App\Category;
use App\Service\CreateService;
use App\Tag;

class BaseController extends Controller
{
    public $service;

    public function __construct(CreateService $service)
    {
        $this->service = $service;
    }
}
