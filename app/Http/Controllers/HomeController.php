<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use Image;
use Socialite;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*try {
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            return dd($e);
        }*/

        try {
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            //return redirect('auth/facebook');
        }
        
        return view('home');
    }

    public function upload(Request $request)
    {
        //$image = $request->file('pic')->isValid();
        return $this->_uploadFile($request->file('pic'));
    }

    private function _uploadFile($file)
    {
        $user = \Auth::user();

        $path = 'app/profile/';
        $upload_path = storage_path($path);

        if (!file_exists($upload_path)) {
            mkdir ($upload_path, 0777, true);
        }

        $filename = $user->id.'.'.$file->getClientOriginalExtension();
        $image = Image::make($file);
        $position = round(($image->height() / 100) * 3);

        $profile = Image::canvas($image->width(), $image->height());
        $watermark  = Image::make($upload_path.'watermark.png')->resize($image->width(), $image->height(), function($c)
        {
            $c->aspectRatio();
        });
        $profile->insert($image);
        $profile->insert($watermark,  'bottom-left', 0, $position);
        $profile->save($upload_path.$filename);

        return response()->download($upload_path.$filename);


//        return redirect()->back()->with('alert-success', 'Il download partirà a breve.');
    }
}
