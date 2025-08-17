<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use Redirect,Response;

class AdminSettingsController extends Controller
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
         ->where('users.id',auth()->user()->id)
         ->get();
 
         return view('pages.admin.settings.index',compact("users"));
 
     }

     public function store(Request $request)
     {
         $table = new User;
         $table->name = $request->input('name');
         $table->email = $request->input('email');
         if ($request->input('password')) {
            $table->password = $request->input('password');
        }
        
   
         $table->save();
      
         return redirect('/admin/settings')->with('success','Account updated successfully.');
     }

    public function update(Request $request, $id)
    {
        $table = User::findOrFail($id);
        $table->username = $request->input('username');
        if ($request->input('password')) {
           $table->password = $request->input('password');
       }
       
  
        $table->save();
     
        return redirect()->back()->with('success','Account updated successfully.');
        

    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $table  = Announcement::where($where)->first();

        return Response::json($table);
    }

    public function sms()
    {
        $basic  = new \Nexmo\Client\Credentials\Basic('Nexmo key', 'Nexmo secret');
        $client = new \Nexmo\Client($basic);
 
        $message = $client->message()->send([
            'to' => '91**********',
            'from' => 'P**********',
            'text' => 'Test Message sent from Vonage SMS API'
        ]);
 
        dd('SMS message has been delivered.');
    }

}
