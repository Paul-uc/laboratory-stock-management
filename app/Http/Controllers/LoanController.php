<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        //
        $loans = Loan::all();
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
