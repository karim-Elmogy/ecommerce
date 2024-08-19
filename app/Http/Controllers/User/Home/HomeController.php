<?php

namespace App\Http\Controllers\User\Home;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Advertisement;
use App\Models\Dashboard\Article;
use App\Models\Dashboard\Category;
use App\Models\Dashboard\newSetting;
use App\Models\Dashboard\Offer;
use App\Models\Dashboard\Package;
use App\Models\Dashboard\Slider;
use App\Models\Dashboard\Story;
use App\Models\Dashboard\Why;

class HomeController extends Controller
{
    public function index()
    {
        return view('user.home.index',get_defined_vars());
    }



}
