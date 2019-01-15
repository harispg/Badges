<?php

namespace App\Http\Controllers;

use App\User;
use App\Badge;
use Illuminate\Http\Request;

class OrderItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'qty' => 'required|integer',
            'badge_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        $user = User::find($request->user_id);
        $usersOrders = $user->orders()->with('status')->get();
        foreach ($usersOrders as $order) {
            if($order->status->first()->name == 'creating'){
                $activeOrder = $order;
            }
        }
        if(!isset($activeOrder) || $activeOrder == null)
        {
            $activeOrder = $user->startNewOrder();
        }
            $item = $activeOrder->addItemOrQuantity($validated);

            flash()->success('Added to cart', 'You now have ' . $item->quantity . ' pcs of ' . $item->name . ' in cart');
            return redirect()->back();
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
