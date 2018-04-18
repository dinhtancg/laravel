<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::paginate(Permission::PAGINATE_LIMIT);
        return view('admin.permission.index', ['permissions' => $permissions]);
    }

    /**
     * Get view create/edit image news
     *
     * @param int|null $id
     * @return Response View
     */
    public function getView($id = null) {
        if ($id){
            $permission = Permission::where('id', '=', $id)->first();
            if(!$permission){
                return redirect(route('admin.permission.index'))->with('error', 'Permission not found.');
            }
        }else {
            $permission = null;
        }
        return view('admin.permission.create',[
            'permission' =>$permission,
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
    public function createPermission(Request $request)
    {
        $id  = $request->id;
        if ($id) {
            $request->validate([
                'name' => "required|max:255|unique:permissions,name,$id,id",
                'description'=>"required",
            ]);
        } else {
            $request->validate([
                'name' => "required|max:255|unique:permissions,name,NULL,id",
                'description'=>"required",
            ]);
        }
        if ($id) {
            $permission = Permission::find($id);
            if (!$permission) {
                return redirect()->route('admin.permission.index')->with('error', 'Permission not found.');
            }
        } else {
            $permission = new Permission();
        }
        $permission->name = $request->name;
        $permission->description = $request->description;

        $permission->save();
        if (!$permission->save()) {
            return redirect()->route('admin.permission.index')->with('error', 'An error occurred, permission has not been saved.');
        }
        return redirect()->route('admin.permission.index')->with('success', 'Permission has been save successfully.');
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
        $target = Permission::find($id);
        if ($target) {
            $target->delete();
            return redirect()->route('admin.permission.index')
                ->with('success', 'Permission has been deleted successfully');
        }
        return redirect()->route('admin.permission.index')
            ->with('error', 'Permission not found');
    }
}
