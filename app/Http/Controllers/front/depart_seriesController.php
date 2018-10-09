<?php

namespace App\Http\Controllers\front;

use App\depart_serie_comments;
use App\depart_serie_rates;
use App\depart_serieses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\home_details;
use App\User;
class depart_seriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $series = depart_serieses::find($id);
        $detail = home_details::where('id',1)->first();


        if(!is_null(Auth::user()))
        {
            $previousRate = depart_serie_rates::where('users_id',Auth::user()->id)->where('depart_serieses_id',$id)->first();
            if(is_null($previousRate)){
                $alreadyRated = 0;
            }
            else{
                $alreadyRated = 1;
            }
        }
        else
        {
            $alreadyRated = 1;
        }

        return view('front.depart_series',['detail'=>$detail,'series'=>$series,'alreadyRated'=>$alreadyRated]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
