<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Pps;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use Redirect,Response;
use App\Mail\Signup;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminAnnouncementController extends Controller
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

         $announcements  = DB::table('announcements')
         ->select('*')
         ->where('announcements.status',0)
         ->get();

         return view('pages.admin.announcement.index',compact("announcements"));

     }

     public function store(Request $request)
     {




            $table = new Announcement;
            $table->title = $request->input('title');
            $table->description = $request->input('description');
            if ($request->hasFile('image')) {
                $file1 = $request->file('image');
                $user1 = auth()->user();
                $filename1 = "announcement" . time() . '.' . $file1->getClientOriginalExtension();
                $file1->move('uploads/image/', $filename1);
                $table->image = $filename1;
            }

            $table->save();
            return redirect('/admin/announcement')->with('success','New announcement successfully added.');



     }

     public function fetchData()
     {
         $data = DB::table('officials')
         ->select('*','officials.id as id')
         ->join('designations','designations.id','officials.designation_id')
         ->where('officials.is_deleted',0)
         ->where('officials.designation_id',auth()->user()->designation_id)
         ->get();
         return response()->json($data);
     }

     public function deleteData($id)
     {
         // Fetch the record to be deleted
         $table = Announcement::FindOrFail($id);

         if (!$table) {
             // Record not found
             return response()->json(['error' => 'Record not found'], 404);
         }

         // Perform the deletion
         $table->delete();

         // Return a success response
         return response()->json(['success' => true]);
     }


    public function update(Request $request, $id)
    {

        if($request->input('is_deleted')  == 1){
            $table = Announcement::findOrFail($id);
            $table->status = 1;
            $table->save();
            return redirect('/admin/announcement')->with('success','Announcement successfully deleted.');

        }else{

            $table = Announcement::findOrFail($id);
            $table->title = $request->input('title');
            $table->description = $request->input('description');
            if ($request->hasFile('image')) {
                $file1 = $request->file('image');
                $user1 = auth()->user();
                $filename1 = "announcement" . time() . '.' . $file1->getClientOriginalExtension();
                $file1->move('uploads/image/', $filename1);
                $table->image = $filename1;
            }
            $table->save();
            return redirect('/admin/announcement')->with('success','Announcement successfully updated.');
        }






    }



}
