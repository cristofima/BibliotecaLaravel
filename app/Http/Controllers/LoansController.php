<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\LoanRequest;
use App\Loan;
use App\User;
use DB;

class LoansController extends Controller
{
    public function index()
    {
        $loans = Loan::latest()->paginate(10);
        return view('panel.loans.index', compact('loans'));
    }

    public function create()
    {
        $books = Book::where('available', true)->orderBy('name')->get();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'client');
        })->orderBy('name')->get();

        return view("panel.loans.create", compact('books', 'users'));
    }

    public function store(LoanRequest $request)
    {
        try {
            DB::beginTransaction();

            $book = Book::findOrFail($request->book_id);
            $book->available = false;
            $book->save();

            Loan::create($request->all());

            DB::commit();

            return redirect('prestamos')->with('success', 'Préstamo registrado');
        } catch (Exception | QueryException $e) {
            DB::rollBack();

            return back()->withErrors(['exception' => 'No se pudo realizar el préstamo']);
        }
    }
}
