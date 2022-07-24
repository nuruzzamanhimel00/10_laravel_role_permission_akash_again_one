<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        abort(403, 'Unauthonticated Access');
    }
       return view("backends.pages.dashboad.index");
    }
}
