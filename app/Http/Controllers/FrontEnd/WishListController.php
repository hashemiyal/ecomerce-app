<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishListController extends Controller
{
 public function index(Request $request){
    return view("frontend.collections.wishlists.index");
 }
}
