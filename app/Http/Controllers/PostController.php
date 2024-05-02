<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function jumlahPostingAuthor(){
        $user = Auth::user();
        $postAdmin=Post::where('username', $user->username)->get();
        $postingan=Post::latest()->get();
        return view('author.index',[ 'postingan'=>$postingan,'postAdmin'=>$postAdmin]);
    }

    public function index_admin()
    {
        $user = Auth::user();
        $posts=Post::where('username',$user->username)->get();
        return view('admin.posts.posts_all', compact('posts'));
    }

    public function admin_create()
    {
        return view('admin.posts.posts_add');
    }

    public function admin_store(Request $request)
    {
        $user = Auth::user();
        // $posts=Post::where('username',$user->username)->get();

       Post::create([
           'title' => $request->author_name,
           'content' => $request->description,
           'date' => now(),
           'username' => $user->username,
       ]);

       $notification = array(
           'message' => 'Postingan Baru berhasil ditambahkan',
           'alert-type' =>'info'
       );

       return redirect()->route('posts.admin')->with($notification);
    }

    public function admin_edit($post_id)
    { $posts=Post::findOrFail($post_id);
        //get data product semua nya berdasarkan id product yang dipilih
        return view('admin.posts.posts_edit', compact('posts'));
    }

    public function admin_update(Request $request, $post_id)
{
    // Find the post by its ID
    $post = Post::findOrFail($post_id);
    $user = Auth::user();


    // Update the post with data from the request
    $post->title = $request->input('title');
    $post->content = $request->input('content');
    $post->username = $user->username;

    // Save the updated post
    $post->save();

    // Redirect back or return a response
    return Redirect::to('/admin/posts/all')->with('success', 'Post updated successfully.');

}


    public function admin_destroy($post_id)
    {
        $posts =Post::findOrFail($post_id);
        Post::findOrFail($post_id)->delete();


        $notification =array(
            'message' =>'Postingan berhasil dihapus',
            'alert-type' =>'success',
        );

        return redirect()->back()->with($notification);
    }


    //bagian author
    public function index_author()
    {
        $user = Auth::user();
        $posts=Post::where('username',$user->username)->get();
        return view('author.posts.posts_all', compact('posts'));
    }

    public function author_create()
    {
        return view('author.posts.posts_add');
    }

    public function author_store(Request $request)
    {
        $user = Auth::user();
        // $posts=Post::where('username',$user->username)->get();
       Post::insert([
           'title' =>$request->post_name,
           'content' =>$request->description,
           'username'=>$user->username,
           'date' =>now()
       ]);


       $notification = array(
           'message' => 'Postingan Baru berhasil ditambahkan',
           'alert-type' =>'info'
       );

       return redirect()->route('posts.author')->with($notification);
    }

    public function author_edit($post_id)
    { $posts=Post::findOrFail($post_id);
        //get data product semua nya berdasarkan id product yang dipilih
        return view('author.posts.posts_edit', compact('posts'));
    }

    public function author_update(Request $request,$post_id)
     {
        // Find the post by its ID
    $post = Post::findOrFail($post_id);
    $user = Auth::user();


    // Update the post with data from the request
    $post->title = $request->input('title');
    $post->content = $request->input('content');
    $post->username = $user->username;

    // Save the updated post
    $post->save();

    // Redirect back or return a response
    return Redirect::to('/author/posts/all')->with('success', 'Post updated successfully.');


    }
    public function author_destroy($post_id)
    {
        $posts =Post::findOrFail($post_id);
        Post::findOrFail($post_id)->delete();


        $notification =array(
            'message' =>'Postingan berhasil dihapus',
            'alert-type' =>'success',
        );

        return redirect()->back()->with($notification);
    }

}
