<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use GuzzleHttp\Client as HttpClient;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
 
    public function __construct()
    {
   
    }

    public function index()
    {
       return view('profile');
    }
    
       public function update(Request $request)
    {
   
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'mobile' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|min:6',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->mobile = $request->mobile;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
