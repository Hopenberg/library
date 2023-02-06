# Library app
- App uses MySql database set on 127.0.0.1:3306
- Database name: library
- Database username: root
- 'php artisan serve' to start the server
\
\
\

## Endpoints available
```+--------+-----------+--------------------------------------+-----------------+------------------------------------------------------------+------------------------------------------+
| Domain | Method    | URI                                  | Name            | Action                                                     | Middleware                               |
+--------+-----------+--------------------------------------+-----------------+------------------------------------------------------------+------------------------------------------+
|        | GET|HEAD  | /                                    |                 | Closure                                                    | web                                      |
|        | GET|HEAD  | api/authors                          | authors.index   | App\Http\Controllers\AuthorController@index                | api                                      |
|        | POST      | api/authors                          | authors.store   | App\Http\Controllers\AuthorController@store                | api                                      |
|        | POST      | api/authors/bind/{authorId}/{bookId} |                 | App\Http\Controllers\AuthorController@bindToBook           | api                                      |
|        | GET|HEAD  | api/authors/find/{name}              |                 | App\Http\Controllers\AuthorController@findByName           | api                                      |
|        | GET|HEAD  | api/authors/{author}                 | authors.show    | App\Http\Controllers\AuthorController@show                 | api                                      |
|        | PUT|PATCH | api/authors/{author}                 | authors.update  | App\Http\Controllers\AuthorController@update               | api                                      |
|        | DELETE    | api/authors/{author}                 | authors.destroy | App\Http\Controllers\AuthorController@destroy              | api                                      |
|        | GET|HEAD  | api/books                            | books.index     | App\Http\Controllers\BookController@index                  | api                                      |
|        | POST      | api/books                            | books.store     | App\Http\Controllers\BookController@store                  | api                                      |
|        | GET|HEAD  | api/books/find-by-author/{id}        |                 | App\Http\Controllers\BookController@findByAuthor           | api                                      |
|        | GET|HEAD  | api/books/{book}                     | books.show      | App\Http\Controllers\BookController@show                   | api                                      |
|        | PUT|PATCH | api/books/{book}                     | books.update    | App\Http\Controllers\BookController@update                 | api                                      |
|        | DELETE    | api/books/{book}                     | books.destroy   | App\Http\Controllers\BookController@destroy                | api                                      |
|        | GET|HEAD  | api/user                             |                 | Closure                                                    | api                                      |
|        |           |                                      |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD  | sanctum/csrf-cookie                  |                 | Laravel\Sanctum\Http\Controllers\CsrfCookieController@show | web                                      |
+--------+-----------+--------------------------------------+-----------------+------------------------------------------------------------+------------------------------------------+
```
- api/authors/bind/{authorId}/{bookId} - binds author to book (point 6. from task - missing only unbinding action)
- api/authors/find/{name} - finds author by name (point 4. from task)
- api/books/find-by-author/{id} - finds books by author (point 5. from task)
\
\
\

## Exemplary data to add Books and Authors
```
Book
{
    "title": "A title",
    "publisher": "A publisher",
    "number_of_pages": 123,
    "is_published": true,
    "author_ids": [7]
}
Author
{
    "first_name": "A first name",
    "last_name": "A last name",
    "country": "Poland",
    "book_ids": []
}
```
