<?php

namespace App\Http\Controllers;

use App\HttpHelpers\GroceryListHelper;
use Illuminate\Http\Request;

class GroceryListItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groceryListHelper = new GroceryListHelper();
        $response = $groceryListHelper->index();
        $httpResponseCode = $groceryListHelper->getHttpResponseCode();
        return response()->json($response, $httpResponseCode);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $groceryListHelper = new GroceryListHelper();
        $response = $groceryListHelper->store($request->all());
        $httpResponseCode = $groceryListHelper->getHttpResponseCode();
        return response()->json($response, $httpResponseCode);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $groceryListHelper = new GroceryListHelper();
        $response = $groceryListHelper->show($id);
        $httpResponseCode = $groceryListHelper->getHttpResponseCode();
        return response()->json($response, $httpResponseCode);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $groceryListHelper = new GroceryListHelper();
        $response = $groceryListHelper->update($id, $request->all());
        $httpResponseCode = $groceryListHelper->getHttpResponseCode();
        return response()->json($response, $httpResponseCode);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $groceryListHelper = new GroceryListHelper();
        $response = $groceryListHelper->destroy($id);
        $httpResponseCode = $groceryListHelper->getHttpResponseCode();
        return response()->json($response, $httpResponseCode);
    }
}
