<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Mail\PostStored;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StorePostRequest;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Mail::raw('Hello World', function($msg){
        //     $msg->to('junemoenyinyict@gmail.com')->subject('AP Inde Function');
        // });
        $data = Post::where('user_id',auth()->id())->orderBy('id','desc')->get();
        
        return view('home', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        
        $post = Post::create($validated + ['user_id' =>Auth::user()->id]);

         return redirect('/posts')->with('status', config('aprogrammer.message.created'));
    }   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
    //    if($post->user_id != auth()->id()){
    //        abort(403);
    //    }
        $this->authorize('view',$post);
        return view('show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // if($post->user_id != auth()->id()){
        //     abort(403);
        // }
        $this->authorize('view',$post);
        $categories = Category::all();
        return view('edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $validated = $request->validated();
        $post->update($validated);
        return redirect('/posts')->with('status', config('aprogrammer.message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id)->delete();
        return redirect('/posts')->with('status', config('aprogrammer.message.deleted'));
    }
}
