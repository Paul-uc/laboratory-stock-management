<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLoanRequest;
use App\Http\Requests\UpdateLoanRequest;
use App\Models\Category;
use App\Models\Loan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Loan $loan):View
    {
        //
       
        // Get the authenticated user's username
        $username = auth()->user()->username;

        // Retrieve loans with the same username
        $loans = Loan::where('username', $username)->get();
    
        return view('loans.index', compact('loans'));

      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all(); // Fetch categories
        return view('loans.create', compact('categories'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLoanRequest $request)
    {
        //
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        Loan::create($data);
        return to_route('loans.index');


    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        // Check if the authenticated user owns this loan
        if ($loan->user_id !== auth()->id()) {
            abort(403, 'Unauthorized'); // You can customize the error message and response code
        }
    
        // The user is authorized, proceed to show the loan
        return view('loans.show', compact('loan'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan):View 
    {
        // 
        $categories = Category::all();
        
        return view('loans.edit', compact('categories', 'loan'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLoanRequest $request, Loan $loan)
    {
        //
        $data = $request->validated();
        
        $loan->update($data);
       
        return to_route('loans.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan) :RedirectResponse
    {
        //
        $loan->delete();
        return to_route('loans.index');
    }
}
