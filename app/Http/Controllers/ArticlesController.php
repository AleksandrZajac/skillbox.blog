<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest()->get();;
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'title'  => 'required|min:5|max:100',
            'short_description' => 'required|max:255',
            'description'  => 'required',
        ]);

        $articles = Article::where('title', $request->title)->get();

        $count = count($articles);
        if ($count) {
            $count = '-' . ($count + 1);
        } else {
            $count = '';
        }

        $data = $request->input();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title'], '-') . $count;
        };
        $item = new Article($data);
        $item->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $item = Article::where('slug', $slug)->get();

        return view('articles.show', compact('item'));
    }
}
