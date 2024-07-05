<?php

namespace App\Http\Controllers;

use App\HttpHelpers\ProductHelper;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodHelper = new ProductHelper();
        $response = $prodHelper->index();
        $httpResponseCode = $prodHelper->getHttpResponseCode();
        return response()->json($response, $httpResponseCode);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $prodHelper = new ProductHelper();
        $response = $prodHelper->store($request->all());
        $httpResponseCode = $prodHelper->getHttpResponseCode();
        return response()->json($response, $httpResponseCode);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $prodHelper = new ProductHelper();
        $response = $prodHelper->show($id);
        $httpResponseCode = $prodHelper->getHttpResponseCode();
        return response()->json($response, $httpResponseCode);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $prodHelper = new ProductHelper();
        $response = $prodHelper->update($id, $request->all());
        $httpResponseCode = $prodHelper->getHttpResponseCode();
        return response()->json($response, $httpResponseCode);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prodHelper = new ProductHelper();
        $response = $prodHelper->destroy($id);
        $httpResponseCode = $prodHelper->getHttpResponseCode();
        return response()->json($response, $httpResponseCode);
    }
}
