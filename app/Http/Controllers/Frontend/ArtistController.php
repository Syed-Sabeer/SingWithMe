<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ArtistController extends Controller
{
    public function index(){
      
        $faqs = Faq::all();
        return view("frontend.artist.artisit-portal", compact('faqs'));
    }
  

}
