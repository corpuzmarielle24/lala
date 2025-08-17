<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Report;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use Redirect,Response;
use App\Mail\Signup;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminDashboardController extends Controller
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

         $customerCount  = DB::table('reports')
         ->where('status','Missing')
         ->count();

         $kitchenCount  = DB::table('reports')
         ->where('status','Found')
         ->count();

         $staffCount  = DB::table('reports')
         ->count();



         $maleCount  = DB::table('users')
         ->where('role',1)
         ->where('gender','Male')
         ->count();

         $femaleCount  = DB::table('users')
         ->where('role',1)
         ->where('gender','Female')
         ->count();



           // Query to get count of reports grouped by day
           $reports = Report::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
           ->where('status', 'Missing')
           ->groupBy('date')
           ->get();

// Prepare data for chart
$labels = $reports->pluck('date');
$data = $reports->pluck('total');



         // Query to get count of reports grouped by day
         $reports2 = Report::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
         ->where('status', 'Found')
         ->groupBy('date')
         ->get();


                 // Query to get count of reports grouped by month
        $reports3 = Report::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('count(*) as total'))
        ->groupBy('month')
        ->get();

// Prepare data for chart
$labels3 = $reports3->pluck('month');
$data3 = $reports3->pluck('total');
// Prepare data for chart
$labels2 = $reports2->pluck('date');
$data2 = $reports2->pluck('total');


$breeds = Report::select('breed', DB::raw('count(*) as total'))
->groupBy('breed')
->get();

// Prepare data for chart
$labels4 = $breeds->pluck('breed');
$data4 = $breeds->pluck('total');

$breeds2 = Report::select('gender', DB::raw('count(*) as total'))
->groupBy('gender')
->get();

// Prepare data for chart
$labels5 = $breeds2->pluck('gender');
$data5 = $breeds2->pluck('total');


$ages = Report::select('age', DB::raw('count(*) as total'))
->groupBy('age')
->orderBy('age')
->get();

// Prepare data for chart
$labels6 = $ages->pluck('age');
$data6 = $ages->pluck('total');



         return view('pages.admin.dashboard.index',compact("labels6", "data6","labels5", "data5","labels4", "data4","customerCount","kitchenCount","staffCount","labels", "data","labels2", "data2","labels3", "data3"));

     }

     public function store(Request $request)
     {
            // Validate the form data
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'address' => 'required',
                // Add more validation rules as needed
            ]);

            // Create a new Pps instance and save it to the database
            $table2 = new User;
            $username = 'user_' . Str::random(6);
            $table2->username = $username;
            $password = Str::random(8);
            $table2->password = $password;
            $table2->password2 = $password;
            $table2->designation_id = $request->input('address');
            $table2->save();

            $last_user_id = $table2->id;

            $table = new Pps;
            $table->first_name = $request->input('first_name');
            $table->last_name = $request->input('last_name');
            $table->user_id = $last_user_id;
            $table->save();



            // Return the added PPS data
            return response()->json([
                'id' => $table->id,
                'first_name' => $table->first_name,
                'last_name' => $table->last_name,
                'address' => $table->address,
            ]);
     }

     public function fetchData()
     {
         $data = DB::table('pps')
         ->select('*','pps.id as id')
         ->join('users','users.id','pps.user_id')
         ->join('designations','designations.id','users.designation_id')
         ->where('pps.is_deleted',0)
         ->get();
         return response()->json($data);
     }

     public function deleteData($id)
     {
         // Fetch the record to be deleted
         $table = Pps::FindOrFail($id);

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
        // Validate the incoming request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            // Add other validation rules for your fields
        ]);

        $ppsTable = Pps::findOrFail($id);
        $ppsTable->first_name = $request->input('first_name');
        $ppsTable->last_name = $request->input('last_name');
        $ppsTable->save();

        // Update data in the Users table based on user_id from Pps
        $user_id = $ppsTable->user_id;
        $usersTable = User::findOrFail($user_id);
        $usersTable->designation_id = $request->input('address');
        $usersTable->save();

        // Combine data from both tables into a single variable
        $table = [
            'ppsTable' => $ppsTable,
            'usersTable' => $usersTable,
        ];

        // Optionally, you can return a response if needed
        return response()->json([
            'message' => 'Data updated successfully',
            'data' => $table // Include the combined data
        ]);
    }

    public function edit($id)
    {
        $where = array('pps.id' => $id);
        $table = DB::table('pps')
        ->select('*','pps.id as id')
        ->join('users','users.id','pps.user_id')
        ->join('designations','designations.id','users.designation_id')
        ->where($where)
        ->first();

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
