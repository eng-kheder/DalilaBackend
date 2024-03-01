<?php

namespace App\Http\Controllers;

use App\Models\PaymentCard;
use App\Http\Requests\StorePaymentCardRequest;
use App\Http\Requests\UpdatePaymentCardRequest;

class PaymentCardController extends Controller
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
    public function store(StorePaymentCardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentCard $paymentCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentCard $paymentCard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentCardRequest $request, PaymentCard $paymentCard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentCard $paymentCard)
    {
        //
    }
}
