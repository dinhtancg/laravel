<?php

namespace App\Http\Controllers\Admin;

use App\Help;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;
use App\Category;
use Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $categoryId = $request->get('category_id');
        $articles = Article::getIndex($search, $categoryId);
        $articles->setPath('');
        $pagination = $articles->appends([
            'search' => $search,
            'category_id' =>$categoryId,
        ]);
        $categories = Category::all();
        $categoriesHtml = Category::showCategories($categories, $request->category_id);
        return view('admin.article.index', [
            'articles' => $articles,
            'request' => $request->all(),
            'pagination'=>$pagination,
            'categoriesHtml'=> $categoriesHtml,
        ]);
    }

//        $articles = Article::paginate(Article::PAGINATE_LIMIT);
//        return view('admin.article.index', ['articles' => $articles]);
//    }

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
    public function createArticle(Request $request)
    {
        $id  = $request->id;
        if ($id) {
            $request->validate([
                'title' => "required|max:255|unique:articles,title,$id,id",
                'thumbnail'=>"image|mimes:jpg,png,jpeg,gif,svg|max:1000",
                'content' => "required",
            ]);
        } else {
            $request->validate([
                'title' => "required|max:255|unique:articles,title,NULL,id",
                'thumbnail'=>["required","image", "mimes:jpg,png,jpeg,gif,svg"],
                'content' => "required",
            ]);
        }
        if ($id) {
            $article = Article::find($id);
            if (!$article) {
                return redirect()->route('admin.article.index')->with('error', 'Article not found.');
            }else {

                if ( $article->content != $request->content && $article->reject_flag == true ) {
                    $article->reject_flag = false;
                }
            }
        } else {
            $article = new Article();
            $article->user_id = Auth::user()->id;
        }
        $article->category_id = $request-> category;
        $article->title = $request->title;

        $article->content = $request->content;

        $article->slug = Help::generateSlug($request->title);

        $article->comment =  $request->comment;
//        $article->confirmed = is_null($request->confirmed)? $article->confirmed : $request->confirmed;
//        $article->published = is_null($request->published)? $article->published : $request->published;
        if ($request->hasFile('thumbnail')) {
        $image = $request->file('thumbnail');
                $path = storage_path().'/app/public/images/thumbnails/';
                $filename = time() . '.' . $image->getClientOriginalExtension();
                if (!file_exists($path)) {
                    \File::makeDirectory($path, $mode = 0777, true);
                }
                $upload = $image->move($path, $filename);
                $article->thumbnail = 'storage/images/thumbnails/'. $filename;
                if (!$upload) {
                    return redirect()->route('admin.article.index')->with('error', 'Upload file false');
                }
            }
        $article->save();
        if (!$article->save()) {
            return redirect()->route('admin.article.index')->with('error', 'An error occurred, Article has not been saved');
        }
        return redirect()->route('admin.article.index')->with('success','Article has been save successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        if (!$article) {
            return route('admin.article.index')->with('error', "Article not found.");
        }
        return view('admin.article.detail', ['article' => $article]);
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
     * Get view create/edit image news
     *
     * @param int|null $id
     * @return Response View
     */
    public function getView($id = null) {
        if ($id) {
            $article = Article::find($id);
            if (!$article) {
                return redirect()->route('admin.article.index')->with('error','Article not found');
            }
            $cateId = $article->category_id;
        } else {
            $article = null;
            $cateId = null;
        }
        return view('admin.article.create', [
            'article' => $article,
            'categoriesHtml' => Category::showCategories(Category::all(), old('category', $cateId)),
        ]);
    }

    public function confirm($id)
    {
        $article = Article::findOrFail($id);
        if (!$article) {
            return redirect('admin.article.index')->with('error', "Article not found.");
        }
        $article->confirmed = true;
        $article->reject_flag = false;
        $article->save();
        return redirect()->route('admin.article.index')->with('success','Article was confirmed');
    }
    public function publish($id)
    {
        $article = Article::findOrFail($id);
        if (!$article) {
            return redirect()->route('admin.article.index')->with('error', "Article not found.");
        }
        $article->published = true;
        $article->save();
        return redirect()->route('admin.article.index')->with('success','Article was Published');
    }

    public function reject($id) {
        $article = Article::findOrFail($id);
        if (!$article) {
            return redirect('admin.article.index')->with('error', "Article not found.");
        }
        $article->reject_flag = true;
        $article->save();
        return redirect()->back()->with('success', 'Article was rejected!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $target = Article::find($id);
        if ($target) {
            $target->delete();
            return redirect()->route('admin.article.index')
                ->with('success', 'Article has been deleted successfully');
        }
        return redirect()->route('admin.article.index')
            ->with('error', 'Article not found');
    }
}
