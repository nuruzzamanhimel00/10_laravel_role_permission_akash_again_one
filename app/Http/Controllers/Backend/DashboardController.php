<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $user;

    public function __construct(){
        $this->middleware(function($request, $next){
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index(){

    if(is_null($this->user) || !$this->user->can('dashboard.view') ){
        abort(403, 'Sorry !! You are unauthorized to view Dashboard.');
    }
       return view("backends.pages.dashboad.index");
    }
}
