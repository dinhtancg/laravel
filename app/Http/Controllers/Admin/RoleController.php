<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use App\Help\Help;
use App\User;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('permissions')->paginate(Role::PAGINATE_LIMIT);
        return view('admin.role.index', ['roles' => $roles]);
    }

    /**
     * Get view create/edit image news
     *
     * @param int|null $id
     * @return Response View
     */
    public function getView($id = null) {
        if ($id){
            $role = Role::with('permissions')->findOrFail($id);
            if(!$role){
                return redirect(route('admin.role.index'))->with('error', 'Role not found.');
            }
        }else {
            $role = null;

        }
//        dd($role);
//        dd(array_map(function ($a){return $a["id"];}, $role->permissions->toArray()));
        return view('admin.role.create',[
            'role' =>$role,
            'permissions' => Permission::all(),
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
    public function createRole(Request $request)
    {
        $id  = $request->id;
        if ($id) {
            $request->validate([
                'name' => "required|max:255|unique:categories,name,$id,id",
            ]);
        } else {
            $request->validate([
                'name' => "required|max:255|unique:categories,name,NULL,id",
            ]);
        }
        if ($id) {
            $role = Role::find($id);
            if (!$role) {
                return redirect()->route('admin.role.index')->with('error', 'Role not found.');
            }
        } else {
            $role = new Role();
        }
        $role->name = $request->name;
        $role->slug = Help::generateSlug($request->name);

        $role->save();
        $role->permissions()->sync($request->input('permisions'));
        if (!$role->save()) {
            return redirect()->route('admin.role.index')->with('error', 'An error occurred, role has not been saved.');
        }
        return redirect()->route('admin.role.index')->with('success', 'Role has been save successfully.');
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $target = Role::find($id);
        if ($target) {
            $target->delete();
            return redirect()->route('admin.role.index')
                ->with('success', 'Role has been deleted successfully');
        }
        return redirect()->route('admin.role.index')
            ->with('error', 'Role not found');
    }
}
