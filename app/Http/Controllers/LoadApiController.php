<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoadRequest;
use App\Load;
use App\Http\Resources\LoadResource;

class LoadApiController
{

    public function index()
    {
        $loads = Load::with('routeWays')->orderBy('id','desc')->get();

        return LoadResource::collection($loads);
    }

    public function store(StoreLoadRequest $request)
    {
        $load =  Load::create($request->only('name','weight'));
        $load->routeWays()->createMany( $request->get('addresses'));

        return new LoadResource($load);
    }

}
