<?php

namespace App\Http\Controllers\Admin;

use App\Help;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\EmailController;
class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $users = User::with('roles')->paginate(5);
        $users = User::all();
        $count = User::count();
        return view('admin.User.index', ['users' => $users, 'count' => $count]);

    }
    public function getView($id = null) {
        if ($id){
            $users = User::where('id', '=', $id)->first();
        }else {
            $users = null;
        }
//        $roles = Role::all();
//        $categories = Category::all();

        return view('admin.User.create',[
            'users' =>$users,
//            'roles' =>$roles,
//            'categories' => $categories,
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
                return redirect()->route('admin.User.index')->with('error', 'User not found.');
            }
        } else {
            $user = new User();
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $password = Help::generateRandomString();
        $user->password = Hash::make($password);



        $user->save();
//        $user->roles()->sync($request->input('roles'));
        if (!$user->save()) {
            return redirect()->route('admin.User.index')->with('error', 'An error occurred, user has not been saved.');
        }
        $data=[];
        $data['email']= $request->email;
        $data['password']= $password;
        $data['name']= $request->name;
//        $data['roles']= $user->roles()->get()->pluck('name');
        EmailController::sendMail($data);

        return redirect()->route('admin.User.index')->with('success', 'User has been save successfully.');
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
    public function destroy(Request $request)
    {
        $targets = User::whereIn('id', $request->checkbox)->get();
//        dd($targets);
        foreach($targets as $target){
            if ($target) {
//                dd($target);
                $target->delete();
                return redirect()->route('admin.User.index')
                    ->with('success', 'User has been deleted successfully');
            }
            return redirect()->route('admin.User.index')
                ->with('error', 'User not found');
        }

    }
}
