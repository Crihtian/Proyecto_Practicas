<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Register;
use App\Http\Controllers\Controller;
use App\Http\Resources\RegisterResource;


class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registers = Register::with(['student', 'user'])->get();
        return RegisterResource::collection($registers);

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
