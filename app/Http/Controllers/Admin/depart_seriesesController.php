<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use UxWeb\SweetAlert\SweetAlert;
use App\depart_serieses;
use App\departs;
use App\blog_articles;
use App\blogs;
use App\depart_articles;
use App\depart_books;
use App\news;


class depart_seriesesController extends Controller
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

        $departs = departs::all();

        return view('admin.departs.serieses.all',['departs'=>$departs,'departs_count'=>$departs_count,'departs_series_count'=>$departs_series_count
            ,'departs_articles_count'=>$departs_articles_count,'departs_books_count'=>$departs_books_count
            ,'news_count'=>$news_count,'blogs_count'=>$blogs_count,'blogs_article_count'=>$blogs_article_count]);
    }

    public function get_serieses($filter)
    {
        $series = depart_serieses::latest()->get(['depart_serieses.*']);
        if($filter != 0)
            $series = $series->where('departs_id',$filter);

        return Datatables::of($series)
            ->addIndexColumn()
            ->addColumn('depart', function ($series)
            {
                $depart = departs::where('id',$series->departs_id)->first();
                return $depart->name;

            })
            ->addColumn('action', function ($series)
            {
                return '<a href="serieses/'.$series->id.'/edit" class="btn btn-xs btn-primary">
            <i class="fa fa-pencil-square-o"></i> تعديل</a> 
            <a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#deletemodel'.$series->id.'">
            <i class="fa fa-trash-o"></i> حذف</a>
            
            <div class="modal fade" id="deletemodel'.$series->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">هل انت متاكد من انك تريد حذف هذه الحلقه؟</h4>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">برجاء العلم انك اذا قمت بحذف هذه الحلقه فسوف يتم حذف كل التعليقات التقييمات عليها</p>
                            <form action='. url('admin/serieses/'.$series->id) .' method="post" class="text-center"> '.
                    csrf_field().
                    method_field('DELETE').'
                               <button class="btn btn-default" type="submit">
                                    حذف
                                </button>
                                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">إلغاء</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            ';
            })
            ->make (true);
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


        $departs = departs::all();
        return view('admin.departs.serieses.new',['departs'=>$departs,'departs_count'=>$departs_count,'departs_series_count'=>$departs_series_count
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
        $series = new depart_serieses;
        $this->validate($request,[
            'depart'=>'required',
            'type'=>'required',
        ]);


        $series->departs_id = $request->depart;
        $series->type = $request->type;
        if ($request->type == 0)
        {
            $this->validate($request,[
                'url'=>'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            ]);
            $series->url = $request->url;
        }
        elseif ($request->type == 1)
        {
            $this->validate($request,[
                'video' => 'required|mimes:mp4,mov,ogg'
            ]);

            if($request->hasFile('video')){
                $file=$request->file('video');
                $url=time().$file->getClientOriginalName();
                $desti=public_path('/uploads/videos');
                /*$desti=base_path('/uploads');*/
                if ($file->move($desti ,$url))
                {
                    $series->upload_url=$url;
                }
                else
                {
                    echo 'not move';
                }

            }
            else {

                echo 'Not Uploaded';
            }
        }

        $series->save();

        session()->flash('message',' تمت اضافه '.$series->url.' بنجاح ');

        return redirect(url('admin/serieses'));
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



        $series = depart_serieses::find($id);
        $departs = departs::all();
        return view('admin.departs.serieses.edit',['series'=>$series,'departs'=>$departs,'departs_count'=>$departs_count,'departs_series_count'=>$departs_series_count
            ,'departs_articles_count'=>$departs_articles_count,'departs_books_count'=>$departs_books_count
            ,'news_count'=>$news_count,'blogs_count'=>$blogs_count,'blogs_article_count'=>$blogs_article_count]);
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
        $series = depart_serieses::find($id);
        $this->validate($request,[
            'depart'=>'required',
            'type'=>'required',
        ]);
        $series->departs_id = $request->depart;
        $series->type = $request->type;


        if ($request->type == 0)
        {
            $this->validate($request,[
                'url'=>'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            ]);
            $series->url = $request->url;
            $series->upload_url = null;
        }
        elseif ($request->type == 1)
        {
            $this->validate($request,[
                'video' => 'required|mimes:mp4,mov,ogg'
            ]);

            if($request->hasFile('video')){
                $file=$request->file('video');
                $url=time().$file->getClientOriginalName();
                $desti=public_path('/uploads/videos');
                /*$desti=base_path('/uploads');*/
                if ($file->move($desti ,$url))
                {
                    $series->upload_url=$url;
                    $series->url = null;
                }
                else
                {
                    echo 'not move';
                }

            }
            else {

                echo 'Not Uploaded';
            }
        }

        $series->save();


        $series->save();

        session()->flash('message',' تم تعديل  '.$series->url.' بنجاح ');

        return redirect(url('admin/serieses'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $series = depart_serieses::find($id);
        $series->delete();
        session()->flash('message','تم الحذف بنجاح');
        return redirect(url('admin/serieses'));
    }
}
