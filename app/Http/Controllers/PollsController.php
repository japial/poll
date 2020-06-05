<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;
use App\Http\Resources\Poll as PollResource;
use Validator;

class PollsController extends Controller
{
    public function index(){
    	return response()->json(Poll::paginate(10), 200);
    }
	
	public function show($id){
		$poll = new PollResource(Poll::with('questions')->find($id));
		if(is_null($poll)){
    		return response()->json(null, 404);
		}
    	return response()->json($poll, 200);
    }

    public function store(Request $request){
    	$rules = array(
    		'title' => 'required|max:250'
    	);
    	$validator = Validator::make($request->all(), $rules);
    	if($validator->fails()){
    		return response($validator->errors(), 400);
    	}
    	$poll = Poll::create($request->all());
    	return response()->json($poll, 201);
    }

    public function update(Request $request, Poll $poll){
    	$poll->update($request->all());
    	return response()->json($poll, 200);
    }

    public function delete(Poll $poll){
    	$poll->delete();
    	return response()->json(null, 204);
    }

    public function errors(){
    	return response()->json(['msg' => 'Payment is required'], 501);
    } 

    public function questions(Request $request, Poll $poll){
    	$questions = $poll->questions;
    	return response()->json($questions, 200);
    }
}
