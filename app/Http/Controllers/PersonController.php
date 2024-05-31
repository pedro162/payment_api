<?php

namespace App\Http\Controllers;

use App\Application\Handlers\CreatePersonHandler;
use App\Application\Services\PersonApplicationService;
use App\Infrastructure\Persistence\EloquentPersonRepository;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    private PersonApplicationService $taskApplicationService;

    public function __construct(PersonApplicationService $taskApplicationService)
    {
        $this->taskApplicationService = $taskApplicationService;
    }
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
        $objRepo = new EloquentPersonRepository();
        $objHendler = new CreatePersonHandler($objRepo);
        $objSerice = new PersonApplicationService($objHendler);
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
