<?php

namespace App\Http\Controllers\tourn\dash;

use App\guides;
use App\matches;
use App\rules;
use App\header_sliders;
use App\reports;
use App\tourn_cybers;
use App\tournaments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Cyber;
use App\cyberImg;
use App\devices;
use App\cyberDevices;
use App\options;
use App\cyberOptions;
use App\zone;
use App\citys;
use App\news;
use App\home_slides;
use App\marquees;
use App\messages;
use App\trade;
use App\operations;
use App\add_sliders;
use App\partner_sliders;
use App\User;
use Yajra\DataTables\Facades\DataTables;
use UxWeb\SweetAlert\SweetAlert;
use Hash;
use Illuminate\Support\Facades\Mail;

class tournamentController extends Controller
{

    public function __construct()

    {

        $this->middleware(function($request,$next)

        {

            if (Auth::check())
            {
                if (Auth::user()->user_type == 0)
                {
                    alert(__('Sorry You cant Access This'))->persistent('Ok');
                    return redirect('front');
                }
                elseif (Auth::user()->user_type == 2)
                {
                    return redirect('cybers');
                }

                elseif (Auth::user()->user_type == 3)
                {
                    return redirect('alltrades');
                }


                return $next($request);

            }

            else
            {
                return redirect('login');
            }



        }
        );

    }

    public function gettourns()
    {
        $tourn = tournaments::latest()->get(['tournaments.*']);

        return Datatables::of($tourn)
            ->addIndexColumn()
            ->addColumn('action', function ($tourn)
            {
                return '<a href="tourn/'.$tourn->id.'/edit" class="btn btn-xs btn-primary">
            <i class="fa fa-pencil-square-o"></i> Edit</a> <a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#deletemodel'.$tourn->id.'">
            <i class="fa fa-trash-o"></i> Delete</a>
            
            <div class="modal fade" id="deletemodel'.$tourn->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Delete!</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are You Sure You Want To delete?</p>
                            <form action='. url('/tourn/'.$tourn->id) .' method="post">'.
                    csrf_field().
                    method_field('DELETE').'
                               <button class="btn btn-default" type="submit">
                                    Delete
                                </button>
                                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Exit</button>
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allcybers = Cyber::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();
        $allcitys=citys::all();
        $allzones=zone::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();


        return view('tourn.dash.tourns',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,'decline'=>$decline
            ,'allcitys'=>$allcitys,'allzones'=>$allzones,'alloptions'=>$alloptions,'alldevices'=>$alldevices,
            'allnews'=>$allnews
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allzones = zone::all();
        $allcitys = citys::all();
        $allcybers = cyber::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();

        return view('tourn.dash.create',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,
            'decline'=>$decline,'allcitys'=>$allcitys,'allzones'=>$allzones,
            'alloptions'=>$alloptions,'alldevices'=>$alldevices,'allnews'=>$allnews
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tourn = new tournaments;
        $this->validate($request,[
            'name'=>'required',
            'name_ar'=>'required',
            'description'=>'required',
            'description_ar'=>'required',
            'file'=>'mimetypes:image/jpeg,image/png',
        ]);
        $tourn->name = $request->name;
        $tourn->description = $request->description;
        if($request->hasFile('file')){
            $file=$request->file('file');
            $url=time().$file->getClientOriginalName();
            /*$desti=public_path('/uploads');*/
            $desti=base_path('/uploads');
            if ($file->move($desti ,$url))
            {
                /*return view('front.img',['file_name'=>$url]);*/
                $tourn->img_url=$url;
            }
            else
            {
                echo 'not move';
            }

        }
        else {

            echo 'Not Uploaded';
        }

        $tourn->save();
        $tourn->translate('en')->name = $request->name;
        $tourn->translateOrNew('ar')->name = $request->name_ar;
        $tourn->translate('en')->description = $request->description;
        $tourn->translateOrNew('ar')->description = $request->description_ar;
        $tourn->save();
        session()->flash('message',$tourn->name.' Added Succesfuly');
        return redirect(url('alltournaments'));
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
        $allcybers = Cyber::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();
        $allcitys=citys::all();
        $allzones=zone::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();
        $tourn = tournaments::find($id);

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();

        return view('tourn.dash.edit',
            ['tourn'=>$tourn,'allcitys'=>$allcitys,'allzones'=>$allzones,
                'allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,
                'decline'=>$decline,'alloptions'=>$alloptions,'alldevices'=>$alldevices,'allnews'=>$allnews
                ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
                ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
                ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations
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
        $tourn = tournaments::find($id);

        $this->validate($request,[
            'name'=>'required',
            'name_ar'=>'required',
            'description'=>'required',
            'description_ar'=>'required',
            'file'=>'mimetypes:image/jpeg,image/png',
        ]);

        $tourn->name = $request->name;
        $tourn->description = $request->description;
        if($request->hasFile('file')){
            $file=$request->file('file');
            $url=time().$file->getClientOriginalName();
            /*$desti=public_path('/uploads');*/
            $desti=base_path('/uploads');
            if ($file->move($desti ,$url))
            {
                /*return view('front.img',['file_name'=>$url]);*/
                $tourn->img_url=$url;
            }
            else
            {
                echo 'not move';
            }

        }
        else {

            echo 'Not Uploaded';
        }

        $tourn->save();
        $tourn->translate('en')->name = $request->name;
        $tourn->translateOrNew('ar')->name = $request->name_ar;
        $tourn->translate('en')->description = $request->description;
        $tourn->translateOrNew('ar')->description = $request->description_ar;
        $tourn->save();
        session()->flash('message',$tourn->name.' Updated Succesfuly');
        return redirect(url('alltournaments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tourn= tournaments::find($id);
        $tourn->delete();
        session()->flash('message',$tourn->name.' deleted Succesfuly');
        return redirect(url('alltournaments'));
    }







    public function get_header_slide()
    {
        $header = header_sliders::latest()->get(['header_sliders.*']);

        return Datatables::of($header)
            ->addIndexColumn()
            ->addColumn('action', function ($header)
            {
                return '<a href="header/'.$header->id.'/edit" class="btn btn-xs btn-primary">
            <i class="fa fa-pencil-square-o"></i> Edit</a> <a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#deletemodel'.$header->id.'">
            <i class="fa fa-trash-o"></i> Delete</a>
            
            <div class="modal fade" id="deletemodel'.$header->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Delete!</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are You Sure You Want To delete?</p>
                            <form action='. url('/header/'.$header->id) .' method="post">'.
                    csrf_field().
                    method_field('DELETE').'
                               <button class="btn btn-default" type="submit">
                                    Delete
                                </button>
                                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Exit</button>
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_header_slide()
    {
        $allcybers = Cyber::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();
        $allcitys=citys::all();
        $allzones=zone::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();


        return view('tourn.dash.headers',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,'decline'=>$decline
            ,'allcitys'=>$allcitys,'allzones'=>$allzones,'alloptions'=>$alloptions,'alldevices'=>$alldevices,
            'allnews'=>$allnews
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations
        ]);
    }



    public function create_header_slide()
    {
        $allzones = zone::all();
        $allcitys = citys::all();
        $allcybers = cyber::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();
        $tourns = tournaments::all();

        return view('tourn.dash.create_slide',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,
            'decline'=>$decline,'allcitys'=>$allcitys,'allzones'=>$allzones,
            'alloptions'=>$alloptions,'alldevices'=>$alldevices,'allnews'=>$allnews
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations,'tourns'=>$tourns
        ]);
    }

    public function store_header_slide(Request $request)
    {
        $slide = new header_sliders;
        $this->validate($request,[
            'file'=>'mimetypes:image/jpeg,image/png',
            'tourn'=>'required'

        ]);
        $slide->tourn_id = $request->tourn;
        $file=$request->file('file');
        $url=time().$file->getClientOriginalName();
        /*$desti=public_path('/uploads');*/
        $desti=base_path('/uploads');
        $slide->save();

        if ($file->move($desti ,$url))
        {
            $slide->img_url=$url;
            $slide->translateOrNew('en')->img_url = $url;
            $slide->save();
        }
        else{
            echo 'not move';
        }
        if($request->hasFile('file_ar')){
            $file_ar=$request->file('file_ar');
            $url_ar=time().$file_ar->getClientOriginalName();
            /*$desti=public_path('/uploads');*/
            $desti=base_path('/uploads');
            if($file_ar->move($desti ,$url_ar)){
                $slide->translateOrNew('ar')->img_url = $url_ar;
                $slide->save();
            }
            else{
                echo 'not uploaded ar';
            }
        }
        session()->flash('message',$slide->img_url.' Added Succesfuly');
        return redirect(url('allheader'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_header($id)
    {
        $allcybers = Cyber::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();
        $allcitys=citys::all();
        $allzones=zone::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();
        $header = header_sliders::find($id);
        $tourns = tournaments::all();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();

        return view('tourn.dash.edit_header',
            ['header'=>$header,'tourns'=>$tourns,'allcitys'=>$allcitys,'allzones'=>$allzones,
                'allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,
                'decline'=>$decline,'alloptions'=>$alloptions,'alldevices'=>$alldevices,'allnews'=>$allnews
                ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
                ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
                ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_header(Request $request, $id)
    {
        $header = header_sliders::find($id);

        $this->validate($request,[
            'tourn'=>'required',
            'file'=>'mimetypes:image/jpeg,image/png',
        ]);

        $header->tourn_id = $request->tourn;
        if($request->hasFile('file')){
            $file=$request->file('file');
            $url=time().$file->getClientOriginalName();
            /*$desti=public_path('/uploads');*/
            $desti=base_path('/uploads');
            if ($file->move($desti ,$url))
            {
                $header->img_url=$url;
                $header->translateOrNew('en')->img_url = $url;
                $header->save();
            }
            else{
                echo 'not move';
            }
        }
        if($request->hasFile('file_ar')){
            $file_ar=$request->file('file_ar');
            $url_ar=time().$file_ar->getClientOriginalName();
            /*$desti=public_path('/uploads');*/
            $desti=base_path('/uploads');
            if($file_ar->move($desti ,$url_ar)){
                $header->translateOrNew('ar')->img_url = $url_ar;
                $header->save();
            }
            else{
                echo 'not uploaded ar';
            }
        }

        $header->save();
        session()->flash('message',$header->img_url.' Updated Succesfuly');
        return redirect(url('allheader'));
    }



    public function destroy_header($id)
    {
        $header= header_sliders::find($id);
        $header->delete();
        session()->flash('message',$header->img_url.' deleted Succesfuly');
        return redirect(url('allheader'));
    }





    public function get_adds_slide()
    {
        $add = add_sliders::latest()->get(['add_sliders.*']);

        return Datatables::of($add)
            ->addIndexColumn()
            ->addColumn('action', function ($add)
            {
                return '<a href="add/'.$add->id.'/edit" class="btn btn-xs btn-primary">
            <i class="fa fa-pencil-square-o"></i> Edit</a> <a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#deletemodel'.$add->id.'">
            <i class="fa fa-trash-o"></i> Delete</a>
            
            <div class="modal fade" id="deletemodel'.$add->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Delete!</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are You Sure You Want To delete?</p>
                            <form action='. url('/add/'.$add->id) .' method="post">'.
                    csrf_field().
                    method_field('DELETE').'
                               <button class="btn btn-default" type="submit">
                                    Delete
                                </button>
                                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Exit</button>
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_adds_slide()
    {
        $allcybers = Cyber::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();
        $allcitys=citys::all();
        $allzones=zone::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();


        return view('tourn.dash.adds',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,'decline'=>$decline
            ,'allcitys'=>$allcitys,'allzones'=>$allzones,'alloptions'=>$alloptions,'alldevices'=>$alldevices,
            'allnews'=>$allnews
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations
        ]);
    }


    public function create_adds_slider()
    {
        $allzones = zone::all();
        $allcitys = citys::all();
        $allcybers = cyber::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();
        $tourns = tournaments::all();

        return view('tourn.dash.create_adds_slide',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,
            'decline'=>$decline,'allcitys'=>$allcitys,'allzones'=>$allzones,
            'alloptions'=>$alloptions,'alldevices'=>$alldevices,'allnews'=>$allnews
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations,'tourns'=>$tourns
        ]);
    }


    public function store_adds_slider(Request $request)
    {
        $add = new add_sliders;
        $this->validate($request,[
            'type'=>'required',
            'tourn'=>'required'

        ]);
        $add->tourn_id = $request->tourn;
        $add->type = $request->type;

        if ($add->type == 0)
        {
            $this->validate($request,[
                'file'=>'required'

            ]);
            if($request->hasFile('file')){
                $file=$request->file('file');
                $url=time().$file->getClientOriginalName();
                /*$desti=public_path('/uploads');*/
                $desti=base_path('/uploads');
                if ($file->move($desti ,$url))
                {
                    /*return view('front.img',['file_name'=>$url]);*/
                    $add->img_url=$url;
                }
                else
                {
                    echo 'not move';
                }

            }
            else {

                echo 'Not Uploaded';
            }
            $add->save();
        }
        else if ($add->type == 1)
        {
            $this->validate($request,[
                'source'=>'required'

            ]);
            $add->src = $request->source;
            $add->save();
        }
        session()->flash('message',$add->type.' Added Succesfuly');
        return redirect(url('alltournaments'));


    }


    public function edit_adds($id)
    {
        $allcybers = Cyber::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();
        $allcitys=citys::all();
        $allzones=zone::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();
        $add = add_sliders::find($id);
        $tourns = tournaments::all();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();

        return view('tourn.dash.edit_adds',
            ['tourns'=>$tourns,'add'=>$add,'allcitys'=>$allcitys,'allzones'=>$allzones,
                'allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,
                'decline'=>$decline,'alloptions'=>$alloptions,'alldevices'=>$alldevices,'allnews'=>$allnews
                ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
                ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
                ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_adds(Request $request, $id)
    {
        $add = add_sliders::find($id);
        $this->validate($request,[
            'type'=>'required',
            'tourn'=>'required'
        ]);
        $add->tourn_id = $request->tourn;
        $add->type = $request->type;

        if ($add->type == 0)
        {
            $this->validate($request,[
                'file'=>'required'

            ]);
            if($request->hasFile('file')){
                $file=$request->file('file');
                $url=time().$file->getClientOriginalName();
                /*$desti=public_path('/uploads');*/
                $desti=base_path('/uploads');
                if ($file->move($desti ,$url))
                {
                    /*return view('front.img',['file_name'=>$url]);*/
                    $add->img_url=$url;
                }
                else
                {
                    echo 'not move';
                }

            }
            else {

                echo 'Not Uploaded';
            }
            $add->src=null;
            $add->save();
        }
        else if ($add->type == 1)
        {
            $this->validate($request,[
                'source'=>'required'

            ]);
            $add->src = $request->source;
            $add->img_url = null;
            $add->save();
        }
        session()->flash('message',$add->type.' Added Succesfuly');
        return redirect(url('alladds'));
    }



    public function destroy_adds($id)
    {
        $add= add_sliders::find($id);
        $add->delete();
        session()->flash('message',$add->img_url.' deleted Succesfuly');
        return redirect(url('alladds'));
    }









    public function get_partner_slide()
    {
        $partner = partner_sliders::latest()->get(['partner_sliders.*']);

        return Datatables::of($partner)
            ->addIndexColumn()
            ->addColumn('action', function ($partner)
            {
                return '<a href="partner/'.$partner->id.'/edit" class="btn btn-xs btn-primary">
            <i class="fa fa-pencil-square-o"></i> Edit</a> <a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#deletemodel'.$partner->id.'">
            <i class="fa fa-trash-o"></i> Delete</a>
            
            <div class="modal fade" id="deletemodel'.$partner->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Delete!</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are You Sure You Want To delete?</p>
                            <form action='. url('/partner/'.$partner->id) .' method="post">'.
                    csrf_field().
                    method_field('DELETE').'
                               <button class="btn btn-default" type="submit">
                                    Delete
                                </button>
                                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Exit</button>
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_partner_slide()
    {
        $allcybers = Cyber::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();
        $allcitys=citys::all();
        $allzones=zone::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();


        return view('tourn.dash.partners',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,'decline'=>$decline
            ,'allcitys'=>$allcitys,'allzones'=>$allzones,'alloptions'=>$alloptions,'alldevices'=>$alldevices,
            'allnews'=>$allnews
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations
        ]);
    }


    public function create_partner_slide()
    {
        $allzones = zone::all();
        $allcitys = citys::all();
        $allcybers = cyber::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();
        $tourns = tournaments::all();

        return view('tourn.dash.create_partner',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,
            'decline'=>$decline,'allcitys'=>$allcitys,'allzones'=>$allzones,
            'alloptions'=>$alloptions,'alldevices'=>$alldevices,'allnews'=>$allnews
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations,'tourns'=>$tourns
        ]);
    }


    public function store_partner_slider(Request $request)
    {
        $partner = new partner_sliders;
        $this->validate($request,[
            'tourn'=>'required',
            'file'=>'required'
        ]);
        $partner->tourn_id = $request->tourn;
        if($request->hasFile('file')){
            $file=$request->file('file');
            $url=time().$file->getClientOriginalName();
            /*$desti=public_path('/uploads');*/
            $desti=base_path('/uploads');
            if ($file->move($desti ,$url))
            {
                /*return view('front.img',['file_name'=>$url]);*/
                $partner->img_url=$url;
            }
            else
            {
                echo 'not move';
            }

        }
        else {

            echo 'Not Uploaded';
        }
        $partner->save();
        session()->flash('message',$partner->img_url.' Added Succesfuly');
        return redirect(url('allparts'));


    }



    public function edit_partner($id)
    {
        $allcybers = Cyber::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();
        $allcitys=citys::all();
        $allzones=zone::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();
        $partner = partner_sliders::find($id);
        $tourns = tournaments::all();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();

        return view('tourn.dash.edit-partner',
            ['tourns'=>$tourns,'partner'=>$partner,'allcitys'=>$allcitys,'allzones'=>$allzones,
                'allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,
                'decline'=>$decline,'alloptions'=>$alloptions,'alldevices'=>$alldevices,'allnews'=>$allnews
                ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
                ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
                ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_partner(Request $request, $id)
    {
        $partner = partner_sliders::find($id);
        $this->validate($request,[
            'tourn'=>'required',
        ]);
        $partner->tourn_id = $request->tourn;
        if($request->hasFile('file')){
            $file=$request->file('file');
            $url=time().$file->getClientOriginalName();
            /*$desti=public_path('/uploads');*/
            $desti=base_path('/uploads');
            if ($file->move($desti ,$url))
            {
                /*return view('front.img',['file_name'=>$url]);*/
                $partner->img_url=$url;
            }
            else
            {
                echo 'not move';
            }

        }
        else {

            echo 'Not Uploaded';
        }
        $partner->save();
        session()->flash('message',$partner->img_url.' Updated Succesfuly');
        return redirect(url('allparts'));
    }



    public function destroy_partner($id)
    {
        $partner= partner_sliders::find($id);
        $partner->delete();
        session()->flash('message',$partner->img_url.' deleted Succesfuly');
        return redirect(url('allparts'));
    }

    public function add_cyber()
    {
        $allcybers = Cyber::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();
        $allcitys=citys::all();
        $allzones=zone::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();
        $tourns = tournaments::all();

        $tourn_cybers = $approved->keyBy('id');
        foreach($tourn_cybers as $cyber){
            if($cyber->isInTournament($tourns->last()->id)){
                $tourn_cybers->forget($cyber->id);
            }
        }



        return view('tourn.dash.add-cyber',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,'decline'=>$decline
            ,'allcitys'=>$allcitys,'allzones'=>$allzones,'alloptions'=>$alloptions,'alldevices'=>$alldevices,
            'allnews'=>$allnews
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations,'tourns'=>$tourns,'tourn_cybers'=>$tourn_cybers
        ]);
    }

    public function store_cyber(Request $request)
    {
        $cyber = new tourn_cybers;
        $this->validate($request,[
            'tourn'=>'required',
            'cyber'=>'required',
            'user_name'=>'required|unique:tourn_cybers',
            'Password'=>'required',
            'retype_Password'=>'required|same:Password',
        ]);
        $cyber->tourn_id = $request->tourn;
        $cyber->cyber_id = $request->cyber;
        $cyber->user_name = $request->user_name;
        $cyber->password = $request->retype_Password;
        $cyber->save();

        $tourn_cyber = Cyber::where('id',$cyber->cyber_id)->first();

        $cyber->email = $tourn_cyber->email;
        $cyber->save();

        $data = $cyber->toArray();;
        Mail::send('mails.join-tourn',$data,function ($message) use($data){
            $message->to($data['email']);
            $message->subject('Join Tournament');
        });
        session()->flash('message',$cyber->user_name.' Added Succesfuly');
        return redirect(url('joined-list'));
    }


    public function getjoincybers()
    {
        $lastTournament = tournaments::all()->last();
        $torun_cybers_ids = tourn_cybers::where('tourn_id',$lastTournament->id)->where('joined',0)
            ->pluck('cyber_id')->toArray();

        $join_cyber = cyber::latest()->whereIn('id',$torun_cybers_ids)->get();

        return Datatables::of($join_cyber)
            ->addIndexColumn()
            ->addColumn('tournamentUsername', function ($join_cyber)
            {
                $lastTournament = tournaments::all()->last();
                $record = tourn_cybers::where('tourn_id',$lastTournament->id)->where('cyber_id',$join_cyber->id)->first();
                if ($record){
                    return $record->user_name;
                }
                else{
                    return '';
                }
            })
            ->addColumn('# Of Matches', function ($join_cyber)
            {
                $lastTournament = tournaments::all()->last();
                $record = matches::where('tourn_id',$lastTournament->id)->where('cyber_id',$join_cyber->id)->count();
                if ($record){
                    return $record;
                }
                else{
                    return 0;
                }
            })
            ->addColumn('paied matches', function ($join_cyber)
            {
                $lastTournament = tournaments::all()->last();
                $record = tourn_cybers::where('tourn_id',$lastTournament->id)->where('cyber_id',$join_cyber->id)->first();
                if ($record){
                    return $record->paied;
                }
                else{
                    return 0;
                }
            })
            ->addColumn('action', function ($join_cyber)
            {
                return '<a href="join_cyber/'.$join_cyber->id.'/edit" class="btn btn-xs btn-primary">
            <i class="fa fa-pencil-square-o"></i> Edit</a> <a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#deletemodel'.$join_cyber->id.'">
            <i class="fa fa-ban"></i> Block</a>
            
            <div class="modal fade" id="deletemodel'.$join_cyber->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Block!</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are You Sure You Want To Block This Cyber ?</p>
                            <form action='. url('/join_cyber/'.$join_cyber->id.'/block') .' method="post">'.
                    csrf_field().
                    method_field('PUT').'
                            <textarea name="block_reason" style="width: 100%;height: 100px;resize: none" placeholder="block reason"></textarea>
                               <button class="btn btn-default" type="submit">
                                    Block
                                </button>
                                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Exit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            ';
            })
            ->make (true);
    }


    public function index_joined()
    {
        $allzones = zone::all();
        $allcitys = citys::all();
        $allcybers = cyber::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();


        return view('tourn.dash.joined_cybers',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,
            'decline'=>$decline,'allcitys'=>$allcitys,'allzones'=>$allzones,
            'alloptions'=>$alloptions,'alldevices'=>$alldevices,'allnews'=>$allnews
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations
        ]);
    }

    public function block(Request $request, $id)
    {
        $join_cyber = Cyber::find($id);
        $record = tourn_cybers::where('cyber_id',$join_cyber->id)->first();
        if ($record){
            $record->joined = 1;
            $record->block_reason = $request->block_reason;
            $record->save();
            $data = $record->toArray();;
            Mail::send('mails.block-tourn',$data,function ($message) use($data){
                $message->to($data['email']);
                $message->subject('block OF Tournament');
            });
            session()->flash('message',$record->user_name.' Blocked Succesfuly');
            return redirect(url('joined-list'));
        }
        else{
            return '';
        }

    }


    public function getblockcybers()
    {
        $lastTournament = tournaments::all()->last();
        $torun_cybers_ids = tourn_cybers::where('tourn_id',$lastTournament->id)->where('joined',1)
            ->pluck('cyber_id')->toArray();

        $join_cyber = cyber::latest()->whereIn('id',$torun_cybers_ids)->get();

        return Datatables::of($join_cyber)
            ->addIndexColumn()
            ->addColumn('tournamentUsername', function ($join_cyber)
            {
                $lastTournament = tournaments::all()->last();
                $record = tourn_cybers::where('tourn_id',$lastTournament->id)->where('cyber_id',$join_cyber->id)->first();
                if ($record){
                    return $record->user_name;
                }
                else{
                    return '';
                }
            })
            ->addColumn('# Of Matches', function ($join_cyber)
            {
                $lastTournament = tournaments::all()->last();
                $record = matches::where('tourn_id',$lastTournament->id)->where('cyber_id',$join_cyber->id)->count();
                if ($record){
                    return $record;
                }
                else{
                    return 0;
                }
            })
            ->addColumn('paied matches', function ($join_cyber)
            {
                $lastTournament = tournaments::all()->last();
                $record = tourn_cybers::where('tourn_id',$lastTournament->id)->where('cyber_id',$join_cyber->id)->first();
                if ($record){
                    return $record->paied;
                }
                else{
                    return 0;
                }
            })
            ->addColumn('action', function ($join_cyber)
            {
                return '<a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#deletemodel'.$join_cyber->id.'">
            <i class="fa fa-ban"></i> Unblock</a>
            
            <div class="modal fade" id="deletemodel'.$join_cyber->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Unblock!</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are You Sure You Want To Unblock This Cyber ?</p>
                            <form action='. url('/join_cyber/'.$join_cyber->id.'/unblock') .' method="post">'.
                    csrf_field().
                    method_field('PUT').'
                               <button class="btn btn-default" type="submit">
                                    unblock
                                </button>
                                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Exit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            ';
            })
            ->make (true);
    }


    public function index_blocked()
    {
        $allzones = zone::all();
        $allcitys = citys::all();
        $allcybers = cyber::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();


        return view('tourn.dash.blocked-cybers',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,
            'decline'=>$decline,'allcitys'=>$allcitys,'allzones'=>$allzones,
            'alloptions'=>$alloptions,'alldevices'=>$alldevices,'allnews'=>$allnews
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations
        ]);
    }

    public function unblock(Request $request, $id)
    {
        $join_cyber = Cyber::find($id);
        $record = tourn_cybers::where('cyber_id',$join_cyber->id)->first();
        if ($record){
            $record->joined = 0;
            $record->block_reason = '';
            $record->save();
            $data = $record->toArray();;
            Mail::send('mails.unblock-tourn',$data,function ($message) use($data){
                $message->to($data['email']);
                $message->subject('Unblock OF Tournament');
            });
            session()->flash('message',$record->user_name.' Unblocked Succesfuly');
            return redirect(url('blocked-list'));
        }
        else{
            return '';
        }

    }


    public function edit_tourn_cyber($id)
    {
        $allzones = zone::all();
        $allcitys = citys::all();
        $allcybers = cyber::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();
        $join_cyber = tourn_cybers::find($id);
        $join_cyber = Cyber::find($id);
        $record = tourn_cybers::where('cyber_id',$join_cyber->id)->first();


        return view('tourn.dash.edit_tourn_cyber',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,
            'decline'=>$decline,'allcitys'=>$allcitys,'allzones'=>$allzones,
            'alloptions'=>$alloptions,'alldevices'=>$alldevices,'allnews'=>$allnews
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations,'record'=>$record,'join_cyber'=>$join_cyber
        ]);
    }

    public function update_tourn_cyber(Request $request, $id)
    {
        $this->validate($request,[
            'user_name'=>'required',
            'paied'=>'required',
            'retype_Password'=>'required|same:Password',
        ]);

        $join_cyber = Cyber::find($id);
        $record = tourn_cybers::where('cyber_id',$join_cyber->id)->first();

        if ($record)
        {
            $record->user_name = $request->user_name;
            $record->paied = $request->paied;
            $record->password = $request->retype_Password;
            $record->save();
            session()->flash('message',$record->user_name.' updated Succesfuly');
            return redirect(url('joined-list'));
        }
    }


    public function reports()
    {
        $allcybers = Cyber::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();
        $allcitys=citys::all();
        $allzones=zone::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();
        $messages = messages::all();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();


        return view('tourn.dash.reports',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,'decline'=>$decline
            ,'allcitys'=>$allcitys,'allzones'=>$allzones,'alloptions'=>$alloptions,'alldevices'=>$alldevices,
            'allnews'=>$allnews,'messages'=>$messages
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations
        ]);
    }

    public function getreports()
    {
        $report = reports::latest()->get(['reports.*']);

        return Datatables::of($report)
            ->addIndexColumn()
            ->addColumn('action', function ($report)
            {
                return '<a href="report/'.$report->id.'" class="btn btn-xs btn-primary">
            <i class="fa fa-pencil-square-o"></i> view</a>';
            })
            ->make (true);
    }

    public function viewreports($id)
    {
        $allcybers = Cyber::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();
        $allcitys=citys::all();
        $allzones=zone::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();
        $report=reports::find($id);

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();


        return view('tourn.dash.report',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,'decline'=>$decline
            ,'allcitys'=>$allcitys,'allzones'=>$allzones,'alloptions'=>$alloptions,'alldevices'=>$alldevices,
            'allnews'=>$allnews, 'report'=>$report
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations
        ]);
    }




    public function add_rule()
    {
        $allzones = zone::all();
        $allcitys = citys::all();
        $allcybers = cyber::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();
        $tourns = tournaments::all();

        return view('tourn.dash.create_rule',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,
            'decline'=>$decline,'allcitys'=>$allcitys,'allzones'=>$allzones,
            'alloptions'=>$alloptions,'alldevices'=>$alldevices,'allnews'=>$allnews
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations,'tourns'=>$tourns
        ]);
    }

    public function save_rule(Request $request)
    {
        $this->validate($request,[
            'tourn'=>'required',
            'type'=>'required',
            'rule_en'=>'required',
            'rule_ar'=>'required',
        ]);
        $rule = new rules;
        $rule->tourn_id = $request->tourn;
        $rule->type = $request->type;
        $rule->save();

        $rule->translateOrNew('en')->text = $request->rule_en;
        $rule->translateOrNew('ar')->text = $request->rule_ar;
        $rule->save();

        session()->flash('message',$rule->text.' Added Succesfuly');
        return redirect(url('rules'));
    }


    public function rules()
    {
        $allcybers = Cyber::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();
        $allcitys=citys::all();
        $allzones=zone::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();
        $messages = messages::all();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();


        return view('tourn.dash.rules',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,'decline'=>$decline
            ,'allcitys'=>$allcitys,'allzones'=>$allzones,'alloptions'=>$alloptions,'alldevices'=>$alldevices,
            'allnews'=>$allnews,'messages'=>$messages
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations
        ]);
    }

    public function getrule()
    {
        $rule = rules::latest()->get(['rules.*']);

        return Datatables::of($rule)
            ->addIndexColumn()
            ->addColumn('action', function ($rule)
            {
                return '<a href="rule/'.$rule->id.'/edit" class="btn btn-xs btn-primary">
            <i class="fa fa-pencil-square-o"></i> Edit</a> <a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#deletemodel'.$rule->id.'">
            <i class="fa fa-trash-o"></i> Delete</a>
            
            <div class="modal fade" id="deletemodel'.$rule->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Delete!</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are You Sure You Want To delete?</p>
                            <form action='. url('/rule/'.$rule->id) .' method="post">'.
                    csrf_field().
                    method_field('DELETE').'
                               <button class="btn btn-default" type="submit">
                                    Delete
                                </button>
                                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Exit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            ';
            })
            ->make (true);
    }



    public function edit_rule($id)
    {
        $allzones = zone::all();
        $allcitys = citys::all();
        $allcybers = cyber::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();
        $tourns = tournaments::all();

        $rule = rules::find($id);

        return view('tourn.dash.edit-rule',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,
            'decline'=>$decline,'allcitys'=>$allcitys,'allzones'=>$allzones,
            'alloptions'=>$alloptions,'alldevices'=>$alldevices,'allnews'=>$allnews
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations,'tourns'=>$tourns,'rule'=>$rule
        ]);
    }


    public function update_rule(Request $request, $id)
    {
        $this->validate($request,[
            'tourn'=>'required',
            'type'=>'required',
            'rule_en'=>'required',
            'rule_ar'=>'required',
        ]);
        $rule = rules::find($id);

        $rule->tourn_id = $request->tourn;
        $rule->type = $request->type;
        $rule->save();

        $rule->translateOrNew('en')->text = $request->rule_en;
        $rule->translateOrNew('ar')->text = $request->rule_ar;
        $rule->save();

        session()->flash('message',$rule->text.' Updated Succesfuly');
        return redirect(url('rules'));
    }

    public function destroy_rule($id)
    {
        $rule= rules::find($id);
        $rule->delete();
        session()->flash('message',$rule->text.' deleted Succesfuly');
        return redirect(url('rules'));
    }


    public function add_guide()
    {
        $allzones = zone::all();
        $allcitys = citys::all();
        $allcybers = cyber::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();
        $tourns = tournaments::all();

        return view('tourn.dash.create_guide',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,
            'decline'=>$decline,'allcitys'=>$allcitys,'allzones'=>$allzones,
            'alloptions'=>$alloptions,'alldevices'=>$alldevices,'allnews'=>$allnews
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations,'tourns'=>$tourns
        ]);
    }

    public function save_guide(Request $request)
    {
        $this->validate($request,[
            'tourn'=>'required',
            'guide_en'=>'required',
            'guide_ar'=>'required',
        ]);
        $guide = new guides;
        $guide->tourn_id = $request->tourn;
        $guide->save();

        $guide->translateOrNew('en')->text = $request->guide_en;
        $guide->translateOrNew('ar')->text = $request->guide_ar;
        $guide->save();

        session()->flash('message',$guide->text.' Added Succesfuly');
        return redirect(url('guides'));
    }


    public function guides()
    {
        $allcybers = Cyber::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();
        $allcitys=citys::all();
        $allzones=zone::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();
        $messages = messages::all();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();


        return view('tourn.dash.guides',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,'decline'=>$decline
            ,'allcitys'=>$allcitys,'allzones'=>$allzones,'alloptions'=>$alloptions,'alldevices'=>$alldevices,
            'allnews'=>$allnews,'messages'=>$messages
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations
        ]);
    }

    public function getguides()
    {
        $guide = guides::latest()->get(['guides.*']);

        return Datatables::of($guide)
            ->addIndexColumn()
            ->addColumn('action', function ($guide)
            {
                return '<a href="guide/'.$guide->id.'/edit" class="btn btn-xs btn-primary">
            <i class="fa fa-pencil-square-o"></i> Edit</a> <a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#deletemodel'.$guide->id.'">
            <i class="fa fa-trash-o"></i> Delete</a>
            
            <div class="modal fade" id="deletemodel'.$guide->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Delete!</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are You Sure You Want To delete?</p>
                            <form action='. url('/guide/'.$guide->id) .' method="post">'.
                    csrf_field().
                    method_field('DELETE').'
                               <button class="btn btn-default" type="submit">
                                    Delete
                                </button>
                                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Exit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            ';
            })
            ->make (true);
    }


    public function edit_guide($id)
    {
        $allzones = zone::all();
        $allcitys = citys::all();
        $allcybers = cyber::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();
        $tourns = tournaments::all();

        $guide = guides::find($id);

        return view('tourn.dash.edit-guide',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,
            'decline'=>$decline,'allcitys'=>$allcitys,'allzones'=>$allzones,
            'alloptions'=>$alloptions,'alldevices'=>$alldevices,'allnews'=>$allnews
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations,'tourns'=>$tourns,'guide'=>$guide
        ]);
    }


    public function update_guide(Request $request, $id)
    {
        $this->validate($request,[
            'tourn'=>'required',
            'guide_en'=>'required',
            'guide_ar'=>'required',
        ]);
        $guide = guides::find($id);

        $guide->tourn_id = $request->tourn;
        $guide->save();

        $guide->translateOrNew('en')->text = $request->guide_en;
        $guide->translateOrNew('ar')->text = $request->guide_ar;
        $guide->save();

        session()->flash('message',$guide->text.' Updated Succesfuly');
        return redirect(url('guides'));
    }

    public function destroy_guide($id)
    {
        $guide= guides::find($id);
        $guide->delete();
        session()->flash('message',$guide->text.' deleted Succesfuly');
        return redirect(url('guides'));
    }


    public function players()
    {
        $allcybers = Cyber::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();
        $allcitys=citys::all();
        $allzones=zone::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();
        $messages = messages::all();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();


        return view('tourn.dash.players',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,'decline'=>$decline
            ,'allcitys'=>$allcitys,'allzones'=>$allzones,'alloptions'=>$alloptions,'alldevices'=>$alldevices,
            'allnews'=>$allnews,'messages'=>$messages
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations
        ]);
    }

    public function getplayers()
    {
        $players = User::latest()->where('joined', 1 )->get(['users.*']);

        return Datatables::of($players)
            ->addIndexColumn()
            ->make (true);
    }


    public function getmatches($cyber,$user)
    {
        $lastTournament = tournaments::all()->last();
        $matches = matches::latest()->where('tourn_id',$lastTournament->id)->get();

        if($user != 0)
            $matches = $matches->where('player1_id',$user);
        if ($cyber != 0)
            $matches = $matches->where('cyber_id',$cyber);


        return Datatables::of($matches)
            ->addIndexColumn()
            ->addColumn('player_1', function ($matches)
            {
                $player_1 = User::where('id',$matches->player1_id)->first();
                if ($player_1)
                {
                    return $player_1->user_name;
                }
                else
                {
                    return '';
                }



            })
            ->addColumn('player_2', function ($matches)
            {
                $player_2 = User::where('id',$matches->player2_id)->first();
                if ($player_2)
                {
                    return $player_2->user_name;
                }
                else
                {
                    return '';
                }



            })

            ->addColumn('cyber', function ($matches)
            {
                $cyber = Cyber::where('id',$matches->cyber_id)->first();
                if ($cyber)
                {
                    return $cyber->name;
                }
                else
                {
                    return '';
                }



            })
            ->addColumn('action', function ($matches)
            {
                return '<a href="matches/'.$matches->id.'/edit" class="btn btn-xs btn-primary">
            <i class="fa fa-pencil-square-o"></i> Edit</a> ';
            })
            ->make (true);
    }



    public function updatematchcyber(Request $request)
    {
        $cyber=$request->cyber_id;
        $matches = matches::where('cyber_id',$cyber)->get();
        $returnMatches = array();
        foreach ($matches as $match)
        {
            $returnMatches [] =['id'=>$match->id,'created_at'=>$match->created_at];
        }
        return json_encode ($returnMatches);
    }



    public function updatematchplayer(Request $request)
    {
        $user=$request->player1_id;
        $matches = matches::where('player1_id',$user)->get();
        $returnMatches = array();
        foreach ($matches as $match)
        {
            $returnMatches [] =['id'=>$match->id,'created_at'=>$match->created_at];
        }
        return json_encode ($returnMatches);
    }




    public function index_matches()
    {
        $allzones = zone::all();
        $allcitys = citys::all();
        $allcybers = cyber::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();

        $users = User::where('joined',1)->get();
        $tourns = tournaments::all();

        $tourn_cybers = $approved->keyBy('id');
        foreach($tourn_cybers as $cyber){
            if(!$cyber->isInTournament($tourns->last()->id)){
                $tourn_cybers->forget($cyber->id);
            }
        }


        return view('tourn.dash.matches',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,
            'decline'=>$decline,'allcitys'=>$allcitys,'allzones'=>$allzones,
            'alloptions'=>$alloptions,'alldevices'=>$alldevices,'allnews'=>$allnews
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations,'users'=>$users,
            'tourn_cybers'=>$tourn_cybers
        ]);
    }


    public function edit_match($id)
    {
        $allcybers = Cyber::all();
        $pendings = Cyber::where('status',0)->get();
        $approved = Cyber::where('status',1)->get();
        $decline = Cyber::where('status',2)->get();
        $allcitys=citys::all();
        $allzones=zone::all();
        $alloptions=options::all();
        $alldevices=devices::all();
        $allnews = news::all();
        $messages = messages::all();

        $allslides = home_slides::count();
        $allmarquees = marquees::count();
        $allmsg = messages::count();
        $alltrades = trade::count();
        $alltradesapproved = trade::where('status',1)->count();
        $alltradespending = trade::where('status',0)->count();
        $alltradesdecline = trade::where('status',2)->count();
        $alloperations = operations::count();

        $match = matches::find($id);

        $user1 = User::where('id',$match->player1_id)->first();
        $user2 = User::where('id',$match->player2_id)->first();


        return view('tourn.dash.edit_match',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,'decline'=>$decline
            ,'allcitys'=>$allcitys,'allzones'=>$allzones,'alloptions'=>$alloptions,'alldevices'=>$alldevices,
            'allnews'=>$allnews,'messages'=>$messages
            ,'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations,'match'=>$match,'user1'=>$user1
            ,'user2'=>$user2
        ]);
    }


    public function update_match(Request $request, $id)
    {
        $match = matches::find($id);
        $oldscore1 = $match->score1;
        $oldscore2 = $match->score2;
        $this->validate($request,[
            'score1'=>'required',
            'score2'=>'required',
        ]);
        $match->score1 = $request->score1;
        $match->score2 = $request->score2;
        $match->save();
        $match->calc_update($oldscore1,$oldscore2);
        session()->flash('message',$match->created_at.' Updated Succesfuly');
        return redirect(url('/matches-list'));

    }



}
