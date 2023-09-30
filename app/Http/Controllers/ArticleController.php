<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('back.article.index', ['articles' => Article::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.article.create', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        /** @var UploadedFile|null $image */
        $request->validated($request->all());

        $image = $request->image;

        $tags = explode(",", $request->tags);

        if ($image != null && !$image->getError()){
            $image = $request->image->store('asset/article', 'public');
        }

        $article = Article::create([
            'title' => $request->title,
            'image' => $image,
            'description' => $request->description,
            'isActive' => $request->isActive,
            'isComment' => $request->isComment,
            'isSharable' => $request->isSharable,

            'category_id' => $request->category_id,
            'author_id' => Auth::user()->id
        ]);

        $article->tag($tags);

        return to_route('article.index')->with('success', 'Article cree avec succes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('back.article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('back.article.create',
            [
                'article' => $article,
                'categories' => Category::all()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        /** @var UploadedFile|null $image */
        $request->validated($request->all());

        $image = $request->image;

        if ($image != null && !$image->getError()){
            if ($article->image){
                Storage::disk('public')->delete($article->image);
            }
            $image = $request->image->store('asset/article', 'public');
        }

        $article->update([
            'title' => $request->title,
            'image' => $image,
            'description' => $request->description,
            'isActive' => $request->isActive,
            'isComment' => $request->isComment,
            'isSharable' => $request->isSharable,
            'category_id' => $request->category_id,
        ]);

        return to_route('article.index')->with('success', 'Article modifie avec succes');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if ($article->image){
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return back()->with('success', 'Aeticle supprime avec succes');
    }
}
