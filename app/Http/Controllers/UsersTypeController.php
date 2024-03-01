<?php

namespace App\Http\Controllers;

use App\Models\UsersType;
use App\Http\Requests\StoreUsersTypeRequest;
use App\Http\Requests\UpdateUsersTypeRequest;

class UsersTypeController extends Controller
{

    public function index() // get all languages
    {
        $allUserTypes = UsersType::all();
        return response()->json($allUserTypes, 200);
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
    public function store(StoreUsersTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UsersType $usersType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UsersType $usersType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsersTypeRequest $request, UsersType $usersType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UsersType $usersType)
    {
        //
    }
}
