<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\DataController;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\LightRequirement;

class ProductController extends Controller
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

        $data = new DataController();
        $product_fp = $data->getProductFootprint();
        return view('admin.pages.addproduct', compact('product_fp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();

        $product->botanical_name = $request->botanical_name;
        $product->common_name = $request->common_name;
        $product->category = $request->category;
        $product->selling_price = $request->selling_price;
        $product->max_discounted_price = $request->max_discounted_price;
        $product->stocked_amount = $request->stocked_amount;
        $product->stocked_amount_units = $request->stocked_amount_units;
        $product->notes = $request->notes;
        $product->publish = $request->publish;
        $product->foliage_color = $request->foliage_color;
        $product->flower_color = $request->flower_color;
        $product->maintenance = $request->maintenance;
        $product->planting_interval = $request->planting_interval;
        $product->planting_interval_units = $request->planting_interval_units;
        $product->mature_spread = $request->mature_spread;
        $product->mature_spread_units = $request->mature_spread_units;
        $product->mature_height = $request->mature_height;
        $product->mature_height_units = $request->mature_height_units;
        $product->water_requirements = $request->water_requirements;
        $product->toxicity_to_humans = $request->toxicity_to_humans;
        $product->toxicity_to_pets = $request->toxicity_to_pets;
        //TO DO
        //Save image
        $product->save();

        $saved_product = Product::latest()->first();

        //Remove all entries for the plant inorder to save again
        LightRequirement::where('plant_id', $saved_product->id)->delete();
        
        foreach($request->light_requirements as $requirement){
            $light_req = new LightRequirement();
            $light_req->plant_id = $saved_product->id;
            $light_req->requirement = $requirement;
            $light_req->save();
        }

        return redirect(route('editProduct', $saved_product->id));
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
        $data = new DataController();
        $product_fp = $data->getProductFootprint();

        $product = Product::where('id', $id)->first();
        $light_req = LightRequirement::where('plant_id', $id);

        return view('admin.pages.addproduct', compact('product_fp', 'product', 'light_req'));
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
