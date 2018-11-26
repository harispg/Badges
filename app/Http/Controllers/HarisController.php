<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HarisController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        //return response('Hello World!')->cookie('haris', 'Ovaj covjek zna da programira kolacice', 1);
        //return $request->cookie('haris');
        //return view('test')->with(compact('id'));
        //return response()->file('/home/haris/Desktop/badges/public/Images/Badges/1542358651bird2.jpg');
        return request()->user();
    }
}
