<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreLoadRequest;
use Illuminate\Support\Facades\DB;
use App\Load;
use App\Route;
use Illuminate\Http\Request;

class LoadController extends Controller
{

    public function load()
    {
        $loads = Load::with('routeWay')->orderBy('id','desc')->get();
        return $loads;
    }

    public function store(StoreLoadRequest $request)
    {
        $load =  Load::create($request->only('name','weight'));
        $route = $load->routeWay()->create($request->only('from','to','date'));
        return $route;
    }

    public function truncateData()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('loads')->truncate();
        DB::table('routes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        factory(Load::class, 20)
            ->create()
            ->each(function ($load) {
                $load->routeWay()->save(factory(Route::class)->make());
            });
        return view('main');
    }

}
