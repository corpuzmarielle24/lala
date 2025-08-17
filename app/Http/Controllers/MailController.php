<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyTestMail;
use Illuminate\Support\Facades\DB;

class MailController extends Controller
{

    public function sendMail(){

        $appointments = DB::table('appointments')
        ->select('*')
        ->join('users','users.id','=','appointments.user_id')
        ->where('appointments.id',1)
        ->get()
        ->toArray();

        Mail::to('batongbakaljason@gmail.com')->send(new MyTestMail($appointments));

    }
}
