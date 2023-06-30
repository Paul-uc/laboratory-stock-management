<?php

namespace App\Http\Controllers;

use App\Models\returnStock;
use Illuminate\Http\Request;

class ReturnStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $returnStock = new ReturnStock;
        $returnStock->title = $request->title;
        $returnStock->body = $request->body;
        $returnStock->isSucessful = $request->has('isSucessful');
        $returnStock->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(returnStock $returnStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(returnStock $returnStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, returnStock $returnStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(returnStock $returnStock)
    {
        //
    }
}
