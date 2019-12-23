<?php

namespace Checkitsedo\Esrpaymentslip\Controllers;

use Checkitsedo\Esrpaymentslip\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('esrpaymentslips::home');
    }
	
	public function admin()
	{
		return view('admin');
	}
}
