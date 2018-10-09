<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'user_name'=>'required|string|unique:users',
            'gender'=>'required|integer',
            'birth_date'=>'required|string',
            'city'=>'required|integer',
            'phone'=>'required|string',
            'verified'=>'required|tinyInteger',
            'email_token'=>'required|string',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->email = $data['email'];
        $user->gender=$data['gender'];
        $user->birth_date=$data['dob'];
        $user->city=$data['city'];
        $user->phone=$data['phone'];
        $user->description=$data['desc'];
        $user->user_name=$data['UserName'];
        $user->save();
        return $user;
//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => bcrypt($data['password']),
//            'user_name'=>$data['UserName'],
//            'gender'=>$data['gender'],
//            'birth_date'=>$data['dob'],
//            'city'=>$data['city'],
//            'phone'=>$data['phone'],
//        ]);
    }

    protected function register(Request $request)
    {
        $input = $request->all();
        $validator = $this->validator($input);

        if ($validator->passes())
        {
            $imageUrl = '';
            if($request->hasFile('file')){
                $file=$request->file('file');
                $url=time().$file->getClientOriginalName();
                $desti=public_path('/uploads');
                if ($file->move($desti ,$url))
                {
                    /*return view('front.img',['file_name'=>$url]);*/
                    $imageUrl=$url;
                }
                else
                {
                    echo 'not move';
                }

            }
            else {

                echo 'Not Uploaded';
            }
            $user = $this->create($input);
            $user->img_url = $imageUrl;
            $user->email_token=$user->id.str_random(25);
            $user->save();
            $data = $user->toArray();
            Mail::send('mails.confirmation',$data,function ($message) use($data){
                $message->to($data['email']);
                $message->subject('Confirmation');
            });
            return redirect(url('front'))->with('status','mail sent');
        }
        return redirect(url('front'));
    }

    public function confirmation($token)
    {
        $user = User::where('email_token',$token)->first();

        if (!is_null($user))
        {
            $user->verified = 1;
            $user->email_token = '';
            $user->save();
            return redirect(url('front'))->with('status','Your Activation is Done');
        }
        return redirect(url('front'))->with('status','Some Thing Went Wrong');
    }
}
