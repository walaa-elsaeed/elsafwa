<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Hash;
use Validator;
use App\citys;
use App\zone;
use App\Cyber;
use App\options;
use App\devices;
use App\news;
use App\home_slides;
use App\marquees;
use App\messages;
use App\trade;
use App\operations;
class ChangePasswordController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Where to redirect users after password is changed.
     *
     * @var string $redirectTo
     */
    protected $redirectTo = '/change_password';

    /**
     * Change password form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showChangePasswordForm()
    {
        $user = Auth::getUser();
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


        return view('auth.change_password',['allcybers'=>$allcybers,'pendings'=>$pendings,'approved'=>$approved,'decline'=>$decline
            ,'allcitys'=>$allcitys,'allzones'=>$allzones,'alloptions'=>$alloptions,'alldevices'=>$alldevices,
            'allnews'=>$allnews,
            'allslides'=>$allslides,'allmarquees'=>$allmarquees,'allmsg'=>$allmsg
            ,'alltrades'=>$alltrades,'alltradesapproved'=>$alltradesapproved,'alltradespending'=>$alltradespending
            ,'alltradesdecline'=>$alltradesdecline,'alloperations'=>$alloperations
        ], compact('user'));
    }

    /**
     * Change password.
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        $user = Auth::getUser();
        $this->validator($request->all())->validate();
        if (Hash::check($request->get('current_password'), $user->password)) {
            $user->password = $request->get('new_password');
            $user->save();
            return redirect($this->redirectTo)->with('success', 'Password change successfully!');
        } else {
            return redirect()->back()->withErrors('Current password is incorrect');
        }
    }

    /**
     * Get a validator for an incoming change password request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
    }
}
