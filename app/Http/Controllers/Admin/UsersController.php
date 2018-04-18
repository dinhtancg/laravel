<?php

namespace App\Http\Controllers\Admin;

use App\Help\Help;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->paginate(5);
        return view('admin.users.index', ['users' => $users]);

    }

    /**
     * Get view create/edit image news
     *
     * @param int|null $id
     * @return Response View
     */
    public function getView($id = null) {
        if ($id){
            $users = User::where('id', '=', $id)->first();
            if(!$users){
                return redirect(route('admin.user.index'))->with('error', 'User not found.');
            }
        }else {
            $users = null;
        }
        $roles = Role::all();
        return view('admin.users.create',[
            'users' =>$users,
            'roles' =>$roles,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->getView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createUser(Request $request)
    {
        $id  = $request->id;
        if ($id) {
            $request->validate([
                'name' => "required|max:255|unique:users,name,$id,id",
                'email'=>"required",
            ]);
        } else {
            $request->validate([
                'name' => "required|max:255|unique:categories,name,NULL,id",
                'email'=>"required",
            ]);
        }
        if ($id) {
            $user = User::find($id);
            if (!$user) {
                return redirect()->route('admin.user.index')->with('error', 'User not found.');
            }
        } else {
            $user = new User();
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $password = Help::generateRandomString();
        $user->password = Hash::make($password);

        $data=[];
        $data['email']= $request->email;
        $data['password']= $password;
        HomeController::sendMail($data);

        $user->save();
        $user->roles()->sync($request->input('roles'));
        if (!$user->save()) {
            return redirect()->route('admin.user.index')->with('error', 'An error occurred, user has not been saved.');
        }


        return redirect()->route('admin.user.index')->with('success', 'User has been save successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->getView($id);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $target = User::find($id);
        if ($target) {
            $target->delete();
            return redirect()->route('admin.user.index')
                ->with('success', 'User has been deleted successfully');
        }
        return redirect()->route('admin.user.index')
            ->with('error', 'User not found');
    }
}
