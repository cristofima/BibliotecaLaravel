<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\BookRequest;
use App\Loan;
use DB;
use Illuminate\Database\QueryException;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('name')->paginate(10);
        return view('panel.books.index', compact('books'));
    }

    public function show($id)
    {
        $book = Book::withCount('loans')->findOrFail($id);
        return view("panel.books.show", compact('book'));
    }

    public function create()
    {
        return view("panel.books.create");
    }

    public function store(BookRequest $request)
    {
        try {
            Book::create($request->all());
            return redirect('libros')->with('success', 'Libro registrado');
        } catch (Exception | QueryException $e) {
            return back()->withErrors(['exception' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view("panel.books.edit", compact('book'));
    }

    public function update(BookRequest $request, $id)
    {
        try {
            Book::updateOrCreate(['id' => $id], $request->all());

            return redirect('libros')->with('success', 'Libro actualizado');
        } catch (Exception | QueryException $e) {
            return back()->withErrors(['exception' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $book = Book::findOrFail($id);
            $book->delete();

            return redirect('libros')->with('success', 'Libro "' . $book->name . '" eliminado');
        } catch (Exception | QueryException $e) {
            return back()->withErrors(['exception' => 'No se pudo eliminar el libro "' . $book->name . '"']);
        }
    }

    public function giveBack($idBook)
    {
        try {
            DB::beginTransaction();

            $book = Book::findOrFail($idBook);
            $book->available = true;
            $book->save();
            $loan = Loan::where('book_id', $idBook)->latest()->first();
            $loan->touch();

            DB::commit();

            return redirect('libros')->with('success', 'Libro "' . $book->name . '" devuelto');
        } catch (Exception | QueryException $e) {
            DB::rollBack();

            return back()->withErrors(['exception' => 'No se pudo devolver el libro']);
        }
    }
}
