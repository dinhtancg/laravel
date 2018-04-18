<?php

namespace App\Http\Controllers\Admin;

use App\Help;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(Category::PAGINATE_LIMIT);
        return view('admin.category.index', ['categories' => $categories]);
    }

    /**
     * Get view create/edit image news
     *
     * @param int|null $id
     * @return Response View
     */
    public function getView($id = null) {
        if ($id){
            $category = Category::where('id', '=', $id)->first();
            if(!$category){
                return redirect(route('admin.category.index'))->with('error', 'Category not found.');
            }
        }else {
        $category = null;
        }
        return view('admin.category.create',[
            'category' =>$category,
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
    public function createCategory(Request $request)
    {
        $id  = $request->id;
        if ($id) {
            $request->validate([
                'name' => "required|max:255|unique:categories,name,$id,id",
                'description'=>"required",
            ]);
        } else {
            $request->validate([
                'name' => "required|max:255|unique:categories,name,NULL,id",
                'description'=>"required",
            ]);
        }
        if ($id) {
            $category = Category::find($id);
            if (!$category) {
                return redirect()->route('admin.category.index')->with('error', 'Category not found.');
            }
        } else {
            $category = new Category();
        }
        $category->name = $request->name;
        $category->slug = Help::generateSlug($request->name);
        $category->description = $request->description;

        $category->save();
        if (!$category->save()) {
            return redirect()->route('admin.category.index')->with('error', 'An error occurred, category has not been saved.');
        }
        return redirect()->route('admin.category.index')->with('success', 'Category has been save successfully.');
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
        $target = Category::find($id);
        if ($target) {
            $target->delete();
            return redirect()->route('admin.category.index')
                ->with('success', 'Category has been deleted successfully');
        }
        return redirect()->route('admin.category.index')
            ->with('error', 'Category not found');
    }
}
