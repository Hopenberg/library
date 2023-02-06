<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Book::all());
    }

    public function findByAuthor(Request $request, int $id)
    {
        return response(Book::whereHas('authors', function ($q) use ($id) {
            $q->where('id', $id);
        })->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = new Book();
        $result->title = $request->title;
        $result->publisher = $request->publisher;
        $result->number_of_pages = $request->number_of_pages;
        $result->is_published = $request->is_published;
        $result->save();
        $result->authors()->attach($request->author_ids);

        return response($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return response(Book::findOrFail($id));
        }
        catch (ModelNotFoundException $e) {
            abort(404);
        }

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
        try {
            $result = Book::findOrFail($id);
            $result->title = $request->title;
            $result->publisher = $request->publisher;
            $result->number_of_pages = $request->number_of_pages;
            $result->is_published = $request->is_published;
            $result->save();
            $result->authors()->attach($request->author_ids);

            return response($result);
        }
        catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::destroy($id);

        return response()->noContent();
    }
}
