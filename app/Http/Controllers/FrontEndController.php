<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logo;
use App\Models\HowItWork;
use App\Models\Service;
use App\Models\Package;
class FrontEndController extends Controller
{
    //    
    public function home() {
        $howItWorks = HowItWork::where('status', 'active')->first();
        $services = Service::where('status', 'Active')->get();
        $logos = Logo::where('status', 'Active')->get();
        $packages = Package::where('status', 'active')->get();
        return view('home-page', compact('howItWorks', 'services', 'logos', 'packages'));

    }
}
