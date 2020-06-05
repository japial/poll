<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;

class PollController extends Controller
{
    public function index(){
    	return response()->json(Poll::get(), 200);
    }
}
