<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Restaurant;

class RestaurantApiController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        return $restaurants;
    }

    public function store(Request $request)
    {
        return User::Restaurant($request->all());
    }

    public function update(Request $request,Restaurant $restaurant)
    {
        return $restaurant->update($request->all());
    }

    public function show(Restaurant $restaurant)
    {
        return $restaurant;
    }

    public function destroy(Restaurant $restaurant)
    {
        return $restaurant->delete();
    }
}