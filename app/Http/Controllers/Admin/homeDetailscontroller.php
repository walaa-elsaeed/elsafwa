<?php

namespace App\Http\Controllers\Admin;

use App\home_details;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\DataTables\Facades\DataTables;
use UxWeb\SweetAlert\SweetAlert;
use App\departs;
use App\depart_serieses;
use App\depart_articles;
use App\depart_books;
use App\news;
use App\blogs;
use App\blog_articles;
use App\home_slides;

class homeDetailscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departs_count = departs::count();
        $departs_series_count = depart_serieses::count();
        $departs_articles_count = depart_articles::count();
        $departs_books_count = depart_books::count();
        $news_count = news::count();
        $blogs_count = blogs::count();
        $blogs_article_count = blog_articles::count();

        $details = home_details::all();

        return view('admin.home.details.all',['departs_count'=>$departs_count,'departs_series_count'=>$departs_series_count
            ,'departs_articles_count'=>$departs_articles_count,'departs_books_count'=>$departs_books_count
            ,'news_count'=>$news_count,'blogs_count'=>$blogs_count,'blogs_article_count'=>$blogs_article_count,'details'=>$details,]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departs_count = departs::count();
        $departs_series_count = depart_serieses::count();
        $departs_articles_count = depart_articles::count();
        $departs_books_count = depart_books::count();
        $news_count = news::count();
        $blogs_count = blogs::count();
        $blogs_article_count = blog_articles::count();

        return view('admin.home.details.new',['departs_count'=>$departs_count,'departs_series_count'=>$departs_series_count
            ,'departs_articles_count'=>$departs_articles_count,'departs_books_count'=>$departs_books_count
            ,'news_count'=>$news_count,'blogs_count'=>$blogs_count,'blogs_article_count'=>$blogs_article_count]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $detail = new home_details;
        $this->validate($request,[
            'description'=>'required',
            'video'=>'required|mimes:mp4,mov,ogg,qt | max:20000',
            'address'=>'required',
            'location'=>'required|url',
            'facebook'=>'required|url',
            'twitter'=>'required|url',
            'youtube'=>'required|url',
        ]);

        $detail->description = $request->description;
        $detail->address = $request->address;
        $detail->location = $request->location;
        $detail->facebook = $request->facebook;
        $detail->twitter = $request->twitter;
        $detail->youtube = $request->youtube;

        if($request->hasFile('video')){
            $file=$request->file('video');
            $url=time().$file->getClientOriginalName();
            $desti=public_path('/uploads');
            /*$desti=base_path('/uploads');*/
            if ($file->move($desti ,$url))
            {
                $detail->video=$url;
            }
            else
            {
                echo 'not move';
            }

        }
        else {

            echo 'Not Uploaded';
        }
        $detail->save();

        session()->flash('message',' تمت اضافه التفاصيل بنجاح ');

        return redirect(url('admin/homedetails'));

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
        $departs_count = departs::count();
        $departs_series_count = depart_serieses::count();
        $departs_articles_count = depart_articles::count();
        $departs_books_count = depart_books::count();
        $news_count = news::count();
        $blogs_count = blogs::count();
        $blogs_article_count = blog_articles::count();

        $detail = home_details::find($id);

        return view('admin.home.details.edit',['departs_count'=>$departs_count,'departs_series_count'=>$departs_series_count
            ,'departs_articles_count'=>$departs_articles_count,'departs_books_count'=>$departs_books_count
            ,'news_count'=>$news_count,'blogs_count'=>$blogs_count,'blogs_article_count'=>$blogs_article_count
            ,'detail'=>$detail
        ]);
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
        $detail = home_details::find($id);
        $this->validate($request,[
            'description'=>'required',
            'video'=>'mimes:mp4,mov,ogg,qt | max:20000',
            'address'=>'required',
            'location'=>'required|url',
            'facebook'=>'required|url',
            'twitter'=>'required|url',
            'youtube'=>'required|url',
        ]);

        $detail->description = $request->description;
        $detail->address = $request->address;
        $detail->location = $request->location;
        $detail->facebook = $request->facebook;
        $detail->twitter = $request->twitter;
        $detail->youtube = $request->youtube;

        if($request->hasFile('video')){
            $file=$request->file('video');
            $url=time().$file->getClientOriginalName();
            $desti=public_path('/uploads');
            /*$desti=base_path('/uploads');*/
            if ($file->move($desti ,$url))
            {
                $detail->video=$url;
            }
            else
            {
                echo 'not move';
            }

        }
        else {

            echo 'Not Uploaded';
        }
        $detail->save();

        session()->flash('message',' تمت تعديل التفاصيل بنجاح ');

        return redirect(url('admin/homedetails'));
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
