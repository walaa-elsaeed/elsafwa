<?php

namespace App\Http\Controllers\front;

use App\interests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\departs;
use App\home_details;
use Illuminate\Support\Facades\Auth;

class departsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detail = home_details::where('id',1)->first();
        $departs = departs::latest()->get();
        return view('front.departs',['detail'=>$detail,'departs'=>$departs]);
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
        $interest = new interests;

        $interest->user_id = Auth::user()->id;

        $interest->depart_id = $request->depart_id;

        $interest->save();

        alert(__('تم اضافه القسم الى قائمه المفضله بنجاح'))->persistent('استمرار');

        return redirect()->back();
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = home_details::where('id',1)->first();
        $depart = departs::find($id);
        if (Auth::check())
        {
            $depart_interest = interests::where('user_id',Auth::user()->id)->where('depart_id',$depart->id)->first();
            return view('front.depart',['detail'=>$detail,'depart'=>$depart,'depart_interest'=>$depart_interest]);
        }
        else
        {
            return view('front.depart',['detail'=>$detail,'depart'=>$depart]);
        }

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
    public function destroy(Request $request, $id)
    {
        $interest = interests::where('depart_id',$id)->where('user_id',Auth::user()->id)->first();

        $interest->delete();

        alert(__('تم حذف القسم من المفضله بنجاح'))->persistent('استمرار');

        return redirect()->back();
    }
}
