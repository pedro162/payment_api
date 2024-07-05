<?php

namespace App\Http\Controllers;

use App\Application\Handlers\CreateTaskHandler;
use App\Application\Services\TaskApplicationService;
use App\Infrastructure\Persistence\EloquentTaskRepository;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private TaskApplicationService $taskApplicationService;
    
    public function __construct(TaskApplicationService $taskApplicationService)
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
        $objRepo = new EloquentTaskRepository();
        $objHendler = new CreateTaskHandler($objRepo);
        $objSerice = new TaskApplicationService($objHendler);
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
