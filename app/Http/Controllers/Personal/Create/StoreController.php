<?php

namespace App\Http\Controllers\Personal\Create;

use App\Http\Requests\Personal\Create\StoreRequest;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {

        $data = $request->validated();
        $this->service->store($data);

        return redirect('/');

    }
}
