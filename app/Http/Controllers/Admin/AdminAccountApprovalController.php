<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use Redirect,Response;
use App\Mail\Signup;
use Illuminate\Support\Facades\Mail;

class AdminAccountApprovalController extends Controller
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


    public function update(Request $request, $id)
    {

        
        $table = User::findOrFail($id);
        if($request->input('status') == 1){
            $message = "Account successfully approved!";
        }else{
            $message = "Account successfully declined!";
        }
       
        $table->is_approved = $request->input('status');
        $table->save();


               
        $appointments = DB::table('users')
        ->select('*')
        ->where('users.id',$id)
        ->get()
        ->toArray();

         $email = $appointments[0]->email;
         $mobile = $appointments[0]->mobile;
        //$email = 'batongbakaljason@gmail.com';
        Mail::to($email)->send(new Signup($appointments));


        try {
            $apiKey = '50795e10';
            $apiSecret = 'p3ynV14bHqrUkchN';
        
            $to =  $mobile;
            $message2 = $message;
        
            $client = new \Nexmo\Client(new \Nexmo\Client\Credentials\Basic($apiKey, $apiSecret));
        
            $response = $client->message()->send([
                'to' => $to,
                'from' => 'KholizAndLopez',
                'text' => $message2
            ]);
        
            // Check for success here if needed
            if ($response->getStatus() == 0) {
                // Message sent successfully
           
               // dd($response);
            } else {
                // Handle error
              //  dd("Error sending message: " . $response->getMessage());
            }
        } catch (\Nexmo\Client\Exception\Request $e) {
          // dd("Nexmo Request Exception: " . $e->getMessage()); 
        } catch (\Exception $e) {
          //  dd("General Exception: " . $e->getMessage());
        }
        

        return redirect()->back()->with('success',$message);
        

    }
}
