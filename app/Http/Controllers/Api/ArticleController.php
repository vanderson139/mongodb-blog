<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * @var Article
     */
    private $model;
    /**
     * @var Guard
     */
    private $guard;

    public function __construct(Guard $guard, Article $model)
    {
        $this->model = $model;
        $this->guard = $guard;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->model->paginate(20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->model->create([
            'title'        => $request->get('title'),
            'slug'         => $request->get('slug'),
            'text'         => $request->get('text'),
            'author'       => $this->guard->user(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = $this->model->findOrFail($id);


        $article->fill([
            'title' => $request->get('title'),
            'slug'  => $request->get('slug'),
            'text'  => $request->get('text'),
        ])->save();

        return $article;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = $this->model->findOrFail($id);

        $article->delete();

        return $article;
    }
}
