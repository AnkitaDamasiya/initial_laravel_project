<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\RestaurantImage;
use Response;



class RestaurantController extends Controller
{
    public function index()
    {
        $data['restaurants'] = Restaurant::orderBy('id','desc')->paginate(5);   
        return view('admin.restaurant.list',$data);
    }
    public function create()
    {
    }

    public function store(Request $request)
    {
        $data = $request->validate([
                'restaurant_name'   =>  'required|string|max:20',
                'email'             =>  'required|email|unique:restaurant',
                'restaurant_code'  =>  'required',
                'restaurant_desc'   =>  'required',
                'restaurant_number' =>  'required|digits:10',
        ]);
        // if ($request->file('image') ){
        //     dd('g');
        //     $file = $request->file('image');
        //     $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        //     $file->move(public_path().'/restaurant/', $fileName);
        // }

        $restaurant = Restaurant::create($data);
        return Response::json($restaurant);
        // $res_img = new RestaurantImage();
        // $res_img->restaurant_id = $restaurant->id;
        // $res_img->image = $fileName;
        // $res_img->save();
        
    }
    public function show(Restaurant $restaurant)
    {}

    public function edit($id)
    {
        $where = array('id' => $id);
        $restaurant  = Restaurant::where($where)->first();
 
        return Response::json($restaurant);
    }

    public function update(Request $request)
    {
        $restaurant = Restaurant::find($request->hdnRestauranttId);
        $restaurant->restaurant_name = $request->restaurant_name;
        $restaurant->restaurant_code = $request->restaurant_code;
        $restaurant->restaurant_desc = $request->restaurant_desc;
        $restaurant->restaurant_number = $request->restaurant_number;
        $restaurant->update();

        $res_img = new RestaurantImage();
        
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        //     $file->move(public_path().'/restaurant/', $fileName);
        //     $res_img->image=$fileName;
        // }
        // $res_img->update();
        
        return redirect()->route('admin.restaurant.index');
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::where('id',$id)->delete();
        return Response::json($restaurant);
    }
}
