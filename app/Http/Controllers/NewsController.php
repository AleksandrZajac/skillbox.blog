<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Http\Requests\NewsRequest;
use App\Services\TagsSynchronizer;

class NewsController extends Controller
{
    private $tagsSynchronizer;

    public function __construct(TagsSynchronizer $tagsSynchronizer)
    {
        $this->tagsSynchronizer = $tagsSynchronizer;
        $this->middleware('can:show,news')->only(['show']);
        $this->middleware('can:admin')->only(['store', 'create', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::latest()->isPublished()->paginate(10);

        return view('news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $news = new News();
        return view('news.edit', compact('news'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\NewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $news = new News();
        $news->title = request('title');
        $news->description = request('description');
        $news->is_published = (bool)request('is_published');

        $news->save();

        $this->tagsSynchronizer->sync(request('tags'), $news);

        return redirect()->route('news.index')->with('success', 'News was created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\NewsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, News $news)
    {
        $news->update($request->all());

        $this->tagsSynchronizer->sync(request('tags'), $news);

        return redirect()->route('admin.news')->with('success', 'News was created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('admin.news')
            ->with('success', 'News was deleted successfully');
    }
}
