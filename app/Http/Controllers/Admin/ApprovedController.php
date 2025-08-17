<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Report;
use Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use Redirect,Response;
use Illuminate\Support\Facades\Hash;

class ApprovedController extends Controller
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

        $orders  = DB::table('reports')
        ->where('reports.status','Found')
        ->where('reports.is_deleted',0)
        ->get();


        return view('pages.admin.order.approved',compact("orders"));

    }

    public function store(Request $request)
    {
        $table = new User;
        $table->name = $request->input('name');
        $table->address = $request->input('address');
        $table->mobile = $request->input('mobile');
        $table->birthdate = $request->input('birthdate');
        $table->gender = $request->input('gender');
        $table->email = $request->input('email');
        $table->username = $request->input('username');
        $table->password = Hash::make($request->input('password'));;
        $table->password2 = $request->input('password');
        $table->is_approved = 1;
        $table->role = 3;
        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $origname = $file->getClientOriginalName();
            // $user1 = auth()->user()->name.'-'.auth()->user()->id;
            $filename = 'id-image'.time().'.'.$extension;
            $file->move('uploads/id_image/', $filename);
            $table->id_image = $filename;
        }

        $table->save();

        return redirect()->back()->with('success','New account successfully added.');
    }
    public function edit($id)
    {
        $where = array('id' => $id);
        $table  = Reservation::where($where)->first();

        return Response::json($table);
    }

    public function update(Request $request, $id)
    {

        $table = Report::findOrFail($id);

        if($request->input('is_deleted') == 1){
            $message = "Report successfully deleted!";
            $table->is_deleted = $request->input('is_deleted');
            $table->save();
        }

        return redirect()->back()->with('success',$message);


    }
}
