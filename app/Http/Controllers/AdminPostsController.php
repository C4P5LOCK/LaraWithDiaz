<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostsRequest;
use Illuminate\Http\Request;
use App\Post;
use App\Photo;
use App\Category;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;


use App\Http\Requests;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::paginate(2);
        
        return view ('Admin.Posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
         //Sending categories array from DB to create post view
         $categories = Category::lists('name','id')->all();

         return view('Admin.Posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        $user = Auth::user();

        $input = $request->all();

        if($file = $request->file('photo_id')){

            $name = time(). $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }

        $user->posts()->create($input); //Thsi enters the user_id to the post

        return redirect ('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::findOrFail($id);
        return view('Admin.Posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);
        $categories = Category::lists('name', 'id')->all();
        return view('Admin.Posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post = Post::findOrFail($id);

        $input = $request->all();

        if($file = $request->file('photo_id')){
            $name = time().$file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }

            $post->update($input);

            //Auth::user()->posts()->whereId($id)->first()->update($input);
            return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);

        unlink(public_path(). $post->photo->file);

        $post->delete();

        
        Session::flash('deleted','Post has been deleted');

        return redirect('/admin/posts');
    }

    public function post($id){
        $post = Post::findOrFail($id);
        $user = Auth::user();
        $photo = Photo::all();
        $comments = $post->comments()->whereIsActive(1)->get();
        return view ('/post',compact('post','comments','user','photo'));
    }
}
