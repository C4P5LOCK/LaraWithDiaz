<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Photo;

class AdminMediaController extends Controller
{
    //
    public function index(){
        $photos = Photo::all();
        return view ('Admin.Media.index',compact('photos'));
    }

    public function create(){
        //
        return view ('Admin.Media.create');
    }

     public function store(Request $request){

        $file = $request->file('file');

        $name = time().$file->getClientOriginalName();

        $file->move('images',$name);

        Photo::create(['file' =>$name]);

     }

     public function destroy($id){
        $photo = Photo::findOrFail($id);
        unlink(public_path().$photo->file);
        $photo->delete();

        return redirect('admin/media');
     }

     public function show($id){

     }

     public function edit(){
        
     }
}
