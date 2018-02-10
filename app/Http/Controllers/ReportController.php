<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\Comment;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function addNewCase(Request $request){
    	$this->validate($request,[
    		'title' => 'required',
    		'description' => 'required',
    		'type' => 'required',
    		'status' => 'required'
    	]);

    	$station = auth()->user()->station->id;

    	$report = Report::create([
    		'title' => $request['title'],
    		'description' => $request['description'],
    		'crime_id' => $request['type'],
    		'station_id' => $station,
    		'status' => $request['status']
    	]);

    	if($report){
    		$notification = array(
                'message' => 'Your report has been recorded.', 
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
    	}
    }

    public function getAllCases(){
        $cases = Report::all();

        $response = array();
        foreach($cases as $case){
            $reported_on = Carbon::parse($case->created_at);
            $temp = array(
                'id' => $case->id,
                'title' => $case->title,
                'station' =>$case->station->station,
                'status' => $case->status,
                'reported_on' => $reported_on->toDateString()
            );

            array_push($response, $temp);
        }

        return json_encode($response);
    }

    public function getCaseDetails($case){
        $report = Report::find($case);

        $response = array(
            'title' => $report->title,
            'description' => $report->description,
            'station' => $report->station->station,
            'status' => $report->status
        );

        return json_encode($response);
    }

    public function getAllComments($case){
        $comments = Report::find($case)->comments;

        $response = array();
        foreach ($comments as $comment) {
            array_push($response, array(
                'name' => $comment->user->name,
                'comment' => $comment->comment
            ));
        }
        return json_encode($response);
    }

    public function addNewComment(Request $request,$case){
        $comment = $request['comment'];

        $result = Comment::create([
            'comment' => $comment,
            'user_id' => auth()->user()->id,
            'report_id' => $case
        ]);

        if($result){
            return '1';
        } else {
            return '0';
        }
    }
}
