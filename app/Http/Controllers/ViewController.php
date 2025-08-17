<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Found;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use Redirect,Response;
use App\Mail\Signup;
use App\Mail\Signups;
use App\Mail\Signupss;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {

        $pets = DB::table('reports')
        ->where('reports.id', $id)
        ->get();

        $idd = $id;


         return view('pages.user.view.index',compact("pets","idd"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->input('status') == "Change Status to Found"){
            $report = Report::findOrFail($request->input('report_id'));
            if($report->case_no == $request->input('case_no')){
                $report->status = 'Found';
                $report->save();
                return redirect('/missing')->with('success', 'Your report changed status into found');

            }else{

                return redirect()->back()->with('error', 'Incorrect case no');

            }

        }else{
            $table = new Found;
            $table->name = $request->input('name');
            $table->email = $request->input('email');
            $table->phone = $request->input('phone');
            $table->description = $request->input('description');
            $table->report_id = $request->input('report_id');




            $report = Report::findOrFail($request->input('report_id'));

            $appointments = [
                [
                    'owner_name' => $report->owner_name,
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'description' => $request->input('description'),
                ]
            ];

            Mail::to($report->email)->send(new Signups($appointments));

            $appointments = [
                [
                    'owner_name' => $report->owner_name,
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'description' => $request->input('description'),
                ]
            ];

            Mail::to($request->input('email'))->send(new Signupss($appointments));




            return redirect()->back()->with('success', 'Your successfully notify the owner!');

        }





    }

    /**
     * Display the specified resource.
     */
    public function show(Leader $leader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leader $leader)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leader $leader)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leader $leader)
    {
        //
    }
}
