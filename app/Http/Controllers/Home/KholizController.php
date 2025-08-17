<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use Redirect,Response;

class KholizController extends Controller
{
    public function __construct()
    {
     
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
     {
        $announcements = DB::table('announcements')
        ->where('announcements.is_deleted', 0)
        ->where('announcements.court', 'kholiz')
        ->orderByDesc('created_at')
        ->get();
    
 
         return view('pages.home.kholiz.index',compact("announcements"));
 
     }

     public function store(Request $request)
     {
         $table = new Announcement;
         $table->title = $request->input('title');
         $table->description = $request->input('description');
         if ($request->hasFile('image')) {
            $file1 = $request->file('image');
            $user1 = auth()->user();
            $filename1 = "{$user1->name}-{$user1->id}-announcement-" . time() . '.' . $file1->getClientOriginalExtension();
            $file1->move('uploads/announcements/', $filename1);
            $table->image = $filename1;
        }
        
         $table->status = $request->input('status');
         $table->save();
      
         return redirect('/admin/announcement')->with('success','New reservation successfully added.');
     }

    public function update(Request $request, $id)
    {
        $table = Announcement::findOrFail($id);
        if($request->input('is_deleted') == 1){
            $message = "Announcement successfully deleted!";
            $table->is_deleted = $request->input('is_deleted');
            $table->save();
        }
        else{
            $message = "Announcement successfully updated!";
            $table->title = $request->input('title2');
            $table->description = $request->input('description2');
            if ($request->hasFile('image2')) {
               $file1 = $request->file('image2');
               $user1 = auth()->user();
               $filename1 = "{$user1->name}-{$user1->id}-announcement-" . time() . '.' . $file1->getClientOriginalExtension();
               $file1->move('uploads/announcements/', $filename1);
               $table->image = $filename1;
           }
           
            $table->status = $request->input('status2');
            $table->save();
        }
        
        return redirect()->back()->with('success',$message);
        

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
