<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Author::all());
    }

    public function findByName(Request $request, $name) 
    {
        if (strlen($name) < 3) 
        {
            throw new InvalidArgumentException(":name parameter is too short (min. 3 characters)");
        }

        return response(Author::where('first_name', 'LIKE', '%' . $name . '%')
            ->orWhere('last_name', 'LIKE', '%' . $name . '%')->get());
    }

    public function bindToBook(Request $request, int $authorId, int $bookId)
    {
        $author = Author::findOrFail($authorId);
        if (count($author->books()->get()) >= 3)
        {
            throw new InvalidArgumentException("Author cannot have more then 3 books assigned to them");
        }

        $author->books()->attach($bookId);

        return response($author);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = new Author();
        $result->first_name = $request->first_name;
        $result->last_name = $request->last_name;
        $result->country = $request->country;
        $result->save();
        $result->books()->attach($request->book_ids);

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
            return response(Author::findOrFail($id));
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
            $result = Author::findOrFail($id);
            $result->first_name = $request->first_name;
            $result->last_name = $request->last_name;
            $result->country = $request->country;
            $result->save();
            $result->books()->attach($request->book_ids);

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
        Author::destroy($id);

        return response()->noContent();
    }
}
