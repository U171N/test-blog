<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\AuthorEmail;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{

    public function jumlahAuthor(){
        $user = Auth::user();
        $postAdmin=Post::where('username', $user->username)->get();
        $postingan=Post::latest()->get();
        $totalAuthor = User::where('role','author')->count();
        return view('admin.index',['totalAuthor'=>$totalAuthor, 'postingan'=>$postingan,'postAdmin'=>$postAdmin]);
    }


    /**
    * Display a listing of the resource.
    */
   public function index()
   {
     $author=User::where('role', 'author')->get();
     return view('admin.akun.semua_author',compact('author'));
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
       return view('admin.akun.tambah_author');
   }

   /**
    * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'post_name' => 'required|string', // Ensure that 'post_name' field is present and is a string
            'email_author' => 'required|email', // Ensure that 'email_author' field is present and is a valid email address
        ]);

        // If validation fails, redirect back with error messages
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If validation passes, proceed with creating the user
        $password = Str::random(8);
        $hashedPassword = Hash::make($password);

        User::create([
            'name' => $request->post_name,
            'username' => $request->post_name, // Assuming username should be the same as name
            'email' => $request->email_author,
            'role' => 'author', // Set the role to 'author'
            'password' => $hashedPassword,
            'created_at' => now(),
        ]);

        // Set SMTP gmail
        Mail::to($request->email_author)->send(new AuthorEmail($password));

        $notification = [
            'message' => 'Data Karyawan Baru berhasil ditambahkan',
            'alert-type' => 'info',
        ];

        return redirect()->route('author.all')->with($notification);
    }
   /**
    * Display the specified resource.
    */
   public function show(string $id)
   {
       // $author = User::findOrFail($id);
       // return view('admin.akun.edit_author',compact('author'));
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit($user_id)
   { $author=User::findOrFail($user_id);
    //get data product semua nya berdasarkan id product yang dipilih
       return view('admin.akun.edit_author',compact('author'));
   }

   /**
    * Update the specified resource in storage.
    */
    public function update(Request $request)
    {
        // Generate a random password and hash it
        $password = Str::random(8);
        $hashedPassword = Hash::make($password);
        $user_id = $request->user_id;
        // Find the user by ID
        $user = User::findOrFail($user_id);

        // Update the user record with the new data
        $user->update([
            'name' => $request->author_name,
            'username' => $request->author_name,
            'email' => $request->email_author,
            'role' => 'author', // You might want to adjust this based on your logic
            'password' => $hashedPassword,
            // 'created_at' => Carbon::now(), // You typically don't update the 'created_at' field
        ]);

        // You might want to send an email with the new password here

        // Redirect the user back or to a specific route
        return redirect()->route('author.admin')->with('success', 'User updated successfully.');
    }



   /**
    * Remove the specified resource from storage.
    */
   public function destroy(string $id)
   {
       $karyawan = User::findOrFail($id);
       User::findOrFail($id)->delete();

       $notification = array(
           'message' => 'Data Author Berhasil di Hapus',
           'alert-type' => 'success',
       );

       return redirect()->back()->with($notification);
   }

    //menampilkan halaman login pada login admin
    public function AdminLogin(){
        return view('admin/login');
    }
     //menampilkan halaman login pada login admin
     public function AuthorLogin(){
        return view('author/login');
    }

    //session logout
    public function AdminDestroy(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }

     //session logout
     public function AuthorDestroy(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/author/login');
    }
}
