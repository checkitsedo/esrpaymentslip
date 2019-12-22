<?php

namespace Checkitsedo\Esrpaymentslip\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Checkitsedo\Esrpaymentslip\Home;

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
