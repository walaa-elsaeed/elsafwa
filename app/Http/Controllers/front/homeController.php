<?php

namespace App\Http\Controllers\front;

use App\blog_articles;
use App\blogs;
use App\depart_articles;
use App\depart_books;
use App\departs;
use App\home_details;
use App\news;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\home_slides;
use App\messages;
use UxWeb\SweetAlert\SweetAlert;
class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = home_slides::latest()->get();
        $detail = home_details::where('id',1)->first();
        return view('front.index',['slides'=>$slides,'detail'=>$detail]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detail = home_details::where('id',1)->first();
        return view('front.contact',['detail'=>$detail]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = new messages;
        $this->validate($request,[
            'email'=>'required',
            'message'=>'required',
        ]);

        $message->mail = $request->email;
        $message->message = $request->message;

        $message->save();

        alert('تم ارسال الرساله , شكرا لك')->persistent('تم');
        return redirect(url('/'));


    }

    public function store_contact(Request $request)
    {
        $message = new messages;
        $this->validate($request,[
            'email'=>'required',
            'message'=>'required',
            'name'=>'required',
            'phone'=>'required',
        ]);

        $message->mail = $request->email;
        $message->message = $request->message;
        $message->name = $request->name;
        $message->phone = $request->phone;

        $message->save();

        alert('تم ارسال الرساله , شكرا لك')->persistent('تم');
        return redirect(url('/contact'));


    }
    public function search($search)
    {
        $detail = home_details::where('id',1)->first();


        $blogs = blogs::where("name", "like", "%$search%")->get();
        $blog_articles = blog_articles::where("name", "like", "%$search%")->orWhere("description", "like", "%$search%")->get();
        $departs = departs::where("name", "like", "%$search%")->get();
        $depart_articles = depart_articles::where("name", "like", "%$search%")->orWhere("description", "like", "%$search%")->get();
        $depart_books = depart_books::where("name", "like", "%$search%")->orWhere("description", "like", "%$search%")->get();
        $news = news::where("name", "like", "%$search%")->orWhere("description", "like", "%$search%")->get();
        $users = User::where("name", "like", "%$search%")->orWhere("email", "like", "%$search%")->get();


        return view('front.search',['detail'=>$detail,'blogs'=>$blogs,'blog_articles'=>$blog_articles
            ,'departs'=>$departs,'depart_articles'=>$depart_articles,'depart_books'=>$depart_books
            ,'news'=>$news,'users'=>$users
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
