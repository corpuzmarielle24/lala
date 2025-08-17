<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use Redirect,Response;

class AdminPendingAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users  = DB::table('users')
        ->where('users.is_approved',0)
        ->where('users.role',1)
        ->where('users.is_deleted',0)
        ->get();

        return view('pages.admin.account.pending',compact("users"));

    }

    public function store(Request $request)
    {
        $table = new Reservation;
        $table->mobile = $request->input('mobile');
        $table->address = $request->input('address');
        $table->purpose = $request->input('purpose');
        $table->court = $request->input('court');
        $table->time = $request->input('time');
        $table->date = $request->input('date');
        $table->user_id = auth()->user()->id;
        $table->save();

        return redirect('/admin/reservation')->with('success','New reservation successfully added.');
    }
    public function edit($id)
    {
        $where = array('id' => $id);
        $table  = Reservation::where($where)->first();

        return Response::json($table);
    }

    public function update(Request $request, $id)
    {
        $table = Reservation::findOrFail($id);
        if($request->input('is_deleted') == 1){
            $message = "Reservation successfully deleted!";
            $table->is_deleted = $request->input('is_deleted');
            $table->save();
        }else{
            $message = "Reservation successfully updated!";
            $table->mobile = $request->input('mobile2');
            $table->address = $request->input('address2');
            $table->purpose = $request->input('purpose2');
            $table->court = $request->input('court2');
            $table->time = $request->input('time2');
            $table->date = $request->input('date2');
            $table->save();
        }

        return redirect()->back()->with('success',$message);


    }
}
