<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use Redirect,Response;
use App\Mail\Signup;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//dd('test');
        return view('pages.user.report.index');

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

        $table = new Report;
        $table->pet_name = $request->input('pet_name');
        $table->breed = $request->input('breed');
        $table->gender = $request->input('gender');
        $table->reward = $request->input('reward');

        $table->age = $request->input('age');
        $table->description = $request->input('description');
        $table->last_address = $request->input('last_address');
        $table->date_type = $request->input('date_type');
     // Check if the 'confidential' input is present in the request
if ($request->has('confidential')) {
    $table->confidential = 1;
} else {
    $table->confidential = 0;
}

      

        

        $table->owner_name = $request->input('owner_name');
        $table->email = $request->input('email');
        $table->phone = $request->input('phone');

        if ($request->hasFile('image1')) {
            $file1 = $request->file('image1');
            $user1 = auth()->user();
            $filename1 = "pet1" . time() . '.' . $file1->getClientOriginalExtension();
            $file1->move('uploads/pet/', $filename1);
            $table->image1 = $filename1;
        }

        if ($request->hasFile('image2')) {
            $file1 = $request->file('image2');
            $user1 = auth()->user();
            $filename2 = "pet2" . time() . '.' . $file1->getClientOriginalExtension();
            $file1->move('uploads/pet/', $filename2);
            $table->image2 = $filename2;
        }

        if ($request->hasFile('image3')) {
            $file1 = $request->file('image3');
            $user1 = auth()->user();
            $filename3 = "pet3" . time() . '.' . $file1->getClientOriginalExtension();
            $file1->move('uploads/pet/', $filename3);
            $table->image3 = $filename3;
        }

        if ($request->hasFile('image4')) {
            $file1 = $request->file('image4');
            $user1 = auth()->user();
            $filename4 = "pet4" . time() . '.' . $file1->getClientOriginalExtension();
            $file1->move('uploads/pet/', $filename4);
            $table->image4 = $filename4;
        }

        if ($request->hasFile('image5')) {
            $file1 = $request->file('image5');
            $user1 = auth()->user();
            $filename5 = "pet5" . time() . '.' . $file1->getClientOriginalExtension();
            $file1->move('uploads/pet/', $filename5);
            $table->image5 = $filename5;
        }

        $petName = $request->input('pet_name');
        $randomCaseNo = 'PawMonitoringCaseNo_' . Str::random(10) . '_' . Str::slug($petName, '_');
        $table->case_no = $randomCaseNo;


        $table->save();
        $ownerName = $request->input('owner_name');
        $appointments = [
            [
                'owner_name' => $ownerName,
                'case_no' => $randomCaseNo,
            ]
        ];

        // Send email using Mailable
        Mail::to($request->input('email'))->send(new Signup($appointments));



        return redirect()->back()->with('success', 'Your pet has been reported missing successfully. Case no. has been sent to your email for your pet monitoring status');

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
