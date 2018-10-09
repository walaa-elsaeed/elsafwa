<?php

namespace App\Http\Controllers\Admin;

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

class sliderHomeController extends Controller
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

        return view('admin.home.slider.all',['departs_count'=>$departs_count,'departs_series_count'=>$departs_series_count
            ,'departs_articles_count'=>$departs_articles_count,'departs_books_count'=>$departs_books_count
            ,'news_count'=>$news_count,'blogs_count'=>$blogs_count,'blogs_article_count'=>$blogs_article_count]);
    }

    public function get_slides()
    {
        $slide = home_slides::latest()->get(['home_slides.*']);

        return Datatables::of($slide)
            ->addIndexColumn()
            ->addColumn('action', function ($slide)
            {
                return '<a href="homeslides/'.$slide->id.'/edit" class="btn btn-xs btn-primary">
            <i class="fa fa-pencil-square-o"></i> تعديل</a> 
            <a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#deletemodel'.$slide->id.'">
            <i class="fa fa-trash-o"></i> حذف</a>
            
            <div class="modal fade" id="deletemodel'.$slide->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">هل انت متاكد من انك تريد حذف هذه الصوره؟</h4>
                        </div>
                        <div class="modal-body">
                            <form action='. url('admin/homeslides/'.$slide->id) .' method="post" class="text-center"> '.
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
            ->addColumn('image', function ($slide)
            {
                $url= $slide->img_url;
                return $url;

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

        return view('admin.home.slider.new',['departs_count'=>$departs_count,'departs_series_count'=>$departs_series_count
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
        $slide = new home_slides;
        $this->validate($request,[
            'file'=>'required|mimetypes:image/jpeg,image/png',
        ]);

        if($request->hasFile('file')){
            $file=$request->file('file');
            $url=time().$file->getClientOriginalName();
            $desti=public_path('/uploads');
            /*$desti=base_path('/uploads');*/
            if ($file->move($desti ,$url))
            {
                $slide->img_url=$url;
            }
            else
            {
                echo 'not move';
            }

        }
        else {

            echo 'Not Uploaded';
        }

        $slide->save();

        session()->flash('message',' تمت اضافه الصوره بنجاح ');

        return redirect(url('admin/homeslides'));
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


        $slide = home_slides::find($id);
        return view('admin.home.slider.edit',['slide'=>$slide,'departs_count'=>$departs_count,'departs_series_count'=>$departs_series_count
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
        $slide = home_slides::find($id);
        $this->validate($request,[
            'file'=>'mimetypes:image/jpeg,image/png',
        ]);



        if($request->hasFile('file')){
            $file=$request->file('file');
            $url=time().$file->getClientOriginalName();
            $desti=public_path('/uploads');
            /*$desti=base_path('/uploads');*/
            if ($file->move($desti ,$url))
            {
                $slide->img_url=$url;
            }
            else
            {
                echo 'not move';
            }

        }
        else {

            echo 'Not Uploaded';
        }

        $slide->save();

        session()->flash('message','تمت تعديل الصوره بنجاح');

        return redirect(url('admin/homeslides'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = home_slides::find($id);
        $slide->delete();
        session()->flash('message','تم الحذف بنجاح');
        return redirect(url('admin/homeslides'));
    }
}
