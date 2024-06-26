<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\DataController;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\LightRequirement;
use App\Models\FoliageColor;
use App\Models\FlowerColor;
use App\Models\GeneralColor;
use App\Models\Gardentype;
use App\Models\ProductCategory;

use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('light_requirement')->with('foliage_color')->with('flower_color')->with('general_color')->with('product_image')->with('gardentype')->get();
        return view('admin.pages.products', compact('products'));
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
        $product;
        if (isset($request->edit_id)){
            //SIMPLY AN EDIT
            $product = Product::where('id', $request->edit_id)->first();
        }else{
            //NEW PRODUCT
            $bot_name_exists = Product::where('botanical_name', $request->botanical_name)->first();
            $com_name_exists = Product::where('common_name', $request->common_name)->first();
            $bot_strlen = strlen(ltrim($request->botanical_name));
            $com_strlen = strlen(ltrim($request->common_name));
    
            if ($bot_strlen > 0 && $bot_name_exists){
                $product =  $bot_name_exists;
            }
            elseif ($com_strlen > 0 && $com_name_exists && $bot_strlen == 0){
                $product =  $com_name_exists;
            }
            else{
                $product = new Product();
            }
        }

        $product->botanical_name = $request->botanical_name;
        $product->common_name = $request->common_name;
        $product->main_category = $request->main_category;
        $product->selling_price = $request->selling_price;
        $product->max_discounted_price = $request->max_discounted_price;
        $product->selling_price = $request->selling_price;
        $product->boq_price = $request->boq_price;
        $product->stocked_qty = $request->stocked_qty;
        $product->stocked_qty_units = $request->stocked_qty_units;
        $product->notes = $request->notes;
        $product->old_info = $request->old_info;
        $product->publish = $request->publish;
        // $product->foliage_color = $request->foliage_color;
        // $product->flower_color = $request->flower_color;
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
        
        $product->save();
        // $saved_product = Product::latest()->first();
        $saved_product = $product;
        
        //Save image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('product_images'), $imageName);

            $product_image = ProductImage::where('image', $imageName)->where('product_id', $saved_product->id)->first();

            //Ensure you don't save same image multiple times for a product
            if (!$product_image){
                $product_image = new ProductImage();
                $product_image->product_id = $saved_product->id;
                $product_image->caption = $request->caption;
                $product_image->image = $imageName;   
                $product_image->save();
            }

        }

        //SAVE LIGHT REQUIREMENTS
        //Remove all entries for the plant inorder to save again
        LightRequirement::where('product_id', $saved_product->id)->delete();
        
        if (isset($request->light_requirements)){
            foreach($request->light_requirements as $requirement){
                $light_req = new LightRequirement();
                $light_req->product_id = $saved_product->id;
                $light_req->requirement = $requirement;
                $light_req->save();
            }
        }

        //SAVE FOLIAGE COLOR REQUIREMENTS
        //Remove all entries for the plant inorder to save again
        FoliageColor::where('product_id', $saved_product->id)->delete();
        
        if (isset($request->foliage_color)){
            foreach($request->foliage_color as $color){
                $col = new FoliageColor();
                $col->product_id = $saved_product->id;
                $col->color = $color;
                $col->save();
            }
        }

        //SAVE FLOWER COLOR REQUIREMENTS
        //Remove all entries for the plant inorder to save again
        FlowerColor::where('product_id', $saved_product->id)->delete();
        
        if (isset($request->flower_color)){
            foreach($request->flower_color as $color){
                $col = new FlowerColor();
                $col->product_id = $saved_product->id;
                $col->color = $color;
                $col->save();
            }
        }

        //SAVE FLOWER COLOR REQUIREMENTS
        //Remove all entries for the plant inorder to save again
        GeneralColor::where('product_id', $saved_product->id)->delete();
        
        if (isset($request->general_color)){
            foreach($request->general_color as $color){
                $col = new GeneralColor();
                $col->product_id = $saved_product->id;
                $col->color = $color;
                $col->save();
            }
        }

        Gardentype::where('product_id', $saved_product->id)->delete();
        
        if (isset($request->gardentype)){
            foreach($request->gardentype as $type){
                $typ = new Gardentype();
                $typ->product_id = $saved_product->id;
                $typ->gardentype = $type;
                $typ->save();
            }
        }

        ProductCategory::where('product_id', $saved_product->id)->delete();
        
        if (isset($request->categories)){
            foreach($request->categories as $cat){
                $category = new ProductCategory();
                $category->product_id = $saved_product->id;
                $category->category = $cat;
                $category->save();
            }
        }

        return redirect(route('products'));
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

        $product = Product::where('id', $id)->with('light_requirement')->with('foliage_color')->with('flower_color')->with('general_color')->with('product_image')->first();

        // return $product;
        return view('admin.pages.addproduct', compact('product_fp', 'product'));
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
    public function destroy(Request $request)
    {
        $product = Product::where('id', $request->delete_product_id)->first();
    
        if ($product){
            LightRequirement::where('product_id', $request->delete_product_id)->delete();
            FoliageColor::where('product_id', $request->delete_product_id)->delete();
            GeneralColor::where('product_id', $request->delete_product_id)->delete();
            $product->delete();

            //Delete associated images
            $db_existing_imgs = ProductImage::where('product_id', $request->delete_product_id)->get();

            foreach($db_existing_imgs as $db_img){
                //delete it
                $imagePath = public_path('product_images/'.$db_img->image);
                if (unlink($imagePath)) { 
                    ProductImage::where('image', $db_img->image)->where('product_id', $request->delete_product_id)->delete();
                } 
            }
        }

        return redirect(route('products'));
    }

    public function editCaption(Request $request){
        $img = ProductImage::where('id', $request->img_id)->where('product_id', $request->product_id)->first();

        if ($img){
            $img->caption = $request->caption;
            $img->save();
        }

        return redirect(route('editProduct', $request->product_id));
    }

    public function deleteImg(Request $request){
        $img = ProductImage::where('id', $request->img_id)->where('product_id', $request->product_id)->first();

        if ($img){
            $imagePath = public_path('product_images/'.$img->image);
                if (file_exists($imagePath)) { 
                    unlink($imagePath);
                } 
                $img->delete();
            return redirect(route('editProduct', $request->product_id));
        }
    }


    //ONE TIME FUNCTION NO LONGER NEEDED - WERE USED TO EXTRACT DATA TO A NEW CREATED TABLE

    /*public function categoryToNewTable(){
        $all_products = Product::all();

        foreach ($all_products as $prod){
            if ($prod->category){
                $cat = new ProductCategory();

                $cat->product_id = $prod->id;
                $cat->category = $prod->category;
                $cat->save();
            }
        }
        
        return "Copy task complete";
    }

    public function removeOldCategories(){
        $all_products = Product::all();

        foreach ($all_products as $prod){
            if ($prod->category){         
                $prod->category = NULL;
                $prod->save();
            }
        }
        
        return "Remove task complete";
    }
    public function mainCategoryAllPlants(){
        $all_products = Product::all();

        foreach ($all_products as $prod){
                  
            $prod->main_category = 'plants';
            $prod->save();
           
        }
        
        return "Remove task complete";
    }*/
    
}
