<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $gender = $request->g;
        $view = $request->v;

        if(!in_array($gender,['Male','Female']) || !in_array($view,['grid','single']))
        {
            $gender = auth()->user()->gender == 'Male' ? 'Female' : 'Male';
            $view = 'grid';

            return redirect()->route('home',['g'=>$gender,'v'=>$view]);
        }

        $data['users'] = User::where('id','!=',auth()->user()->id)
                            ->nearby()
                            ->where('gender',$gender)
                            ->simplePaginate($view == 'grid' ? 9 : 1);
                            
        return view('home',$data);
    }
}
