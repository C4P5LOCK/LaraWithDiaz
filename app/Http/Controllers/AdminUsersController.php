<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateUsersRequest;
use App\Http\Requests\EditUsersRequest;
use App\User;
use App\Role;
use App\Photo;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('Admin.Users.index',compact('users'));
        //dd ($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Sending roles array from DB to create view
        $roles = Role::lists('name','id')->all();

        return view('Admin.Users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUsersRequest $request)
    {
        
        if(trim($request->password) == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
           
        }

        if($file = $request->file('photo_id')){

            $name = time(). $file->getClientOriginalName(); 
            $file->move('images', $name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }

        $input['password'] = bcrypt($request->password);

        User::create($input);
       
        return redirect('/admin/users');
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
        $user = User::findOrFail($id);
        return view('Admin.Users.show',compact('user'));
        //return dd($users);
       
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
      $user =  User::findOrFail($id);
      $roles = Role::lists('name','id')->all();

        return view('Admin.Users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUsersRequest $request, $id)
    {
        //
            if(trim($request->password) == ''){
                $input = $request->except('password');
            }else{
                $input = $request->all();
                $input['password'] = bcrypt($request->password);
               
            }


            $user = User::findOrFail($id);

            if($file = $request->file('photo_id')){

                $name = time().$file->getClientOriginalName();
                $file-> move ('images',$name);

                $photo = Photo::create(['file' => $name]);
                $input['photo_id'] = $photo->id;
            }

             $user->update($input);

             return redirect('/admin/users');
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
        $user = User::findOrFail($id);

        if($user->photo){
            unlink(public_path(). $user->photo->file);
        }
        
        $user->posts()->delete();
        $user->delete();

        
        Session::flash('deleted','User has been deleted');

        return redirect('/admin/users');
        
    }
}
