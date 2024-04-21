<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\DataController;
use App\Models\Project;
use App\Models\Product;
use App\Models\Palette;
use App\Models\Section;
use App\Models\ProductImage;
use App\Models\LightRequirement;
use App\Models\FoliageColor;
use App\Models\FlowerColor;
use App\Models\GeneralColor;
use App\Models\PaletteSection;
use App\Models\ProductCategory;

class PaletteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with('palette')->whereHas('palette', function ($query) {
            $query->where('id', '!=', null);
        })->orderBy('created_at', 'desc')->get();

        return view('admin.pages.palettes', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();

        return view('admin.pages.addPalette', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $palette = Palette::where('project_id', $request->project_id)->first();

        if (!$palette){
            $palette = new Palette();
        }

        $palette->project_id = $request->project_id;
        $palette->notes = $request->notes;
        $palette->save();


        return redirect(route('editPalette', $palette->id));

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
        $palette = Palette::where('id', $id)->with('sections')->first();
        $sections = Section::where('palette_id', $palette->id)->with('paletteSections')->orderBy('order')->get();
        // return $palette;
        $projects = Project::orderBy('created_at', 'desc')->get();
        $all_palettes = Palette::all();
        
        $projects_with_palette = [];
        foreach($all_palettes as $pal){
            array_push($projects_with_palette, $pal->project_id);
        }
        $sections = json_decode(json_encode($sections));
        return view('admin.pages.addPalette', compact('projects', 'palette', 'sections', 'projects_with_palette'));
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

    // public function sectionPage($id){
        
    // }

    public function addSection(Request $request)
    {
        $palette = $this->savePalette($request);
        $project = Project::where('id', $palette->project_id)->first();
        $products = Product::with('light_requirement')->with('foliage_color')->with('flower_color')->with('general_color')->with('product_image')->get();


        if ($request->add_section_section_id){
            //If section already exists fetch its data
            $sectionData = Section::where('id', $request->add_section_section_id)->first();
            return view('admin.pages.newsectionpage', compact('palette', 'project', 'products', 'sectionData'));
        }
        return view('admin.pages.newsectionpage', compact('palette', 'project', 'products'));
    }

    public function savePalette($data){
           
        $palette = Palette::where('project_id', $data->add_section_project_id)->first();
        if (!$palette){
            $palette = new Palette();
        }

        $palette->project_id = $data->add_section_project_id;
        $palette->notes = $data->add_section_palette_notes;
        $palette->save();

        return $palette;
    }

    public function saveSection(Request $request){
        $section;
        if (isset($request->edit_id)){
            $section = Section::where('id', $request->edit_id)->first();
        }else{
            $section = new Section();
        }
        $section->palette_id = $request->palette_id;
        $section->title = $request->title;
        $section->notes = $request->notes;
        $section->save();

        //Remove existing section items ones for a new save
        PaletteSection::where('section_id', $section->id)->delete();
        if (isset($request->choice)){
            foreach ($request->choice as $ch){
                $ch_arr = explode('_', $ch);
                $product_id = $ch_arr[0];
                $img_id = $ch_arr[1];
                $qty = $ch_arr[2];
                if (!$qty){$qty = 0;}
                $rate = $ch_arr[3];
                if (!$rate){$rate = 0;}
                $order = $ch_arr[4];
                if (!$order){$order = 0;}
                $comment = $ch_arr[5];
                if (!$comment){$comment = '';}

                $pal_sect = new PaletteSection();
                $pal_sect->section_id = $section->id;
                $pal_sect->product_id = $product_id;
                $pal_sect->img_id = $img_id;
                $pal_sect->qty = $qty;
                $pal_sect->new_rate = $rate;
                $pal_sect->order = $order;
                $pal_sect->comment = $comment;
                $cat = $this->categorizeProduct($product_id);
                $pal_sect->override_category = $cat;

                $pal_sect->save();
            }

            // return PaletteSection::where('section_id', $section->id)->get();
            // $choice_data = implode(',', $request->choice);
        }
    
        // $section->image_ids = $images;

        return redirect(route('editSection', $section->id));
    }

    public function editSection($id){

        $sectionData = Section::where('id', $id)->first();
        $selection = PaletteSection::where('section_id', $id)->get();
        // return $selection;

        // return $selection;

        $palette;
        $products = Product::with('light_requirement')->with('foliage_color')->with('flower_color')->with('general_color')->with('product_image')->get();


        if ($sectionData){
            $palette = Palette::where('id', $sectionData->palette_id)->first();
            $project = Project::where('id', $palette->project_id)->first();
            return view('admin.pages.newsectionpage', compact('palette', 'project', 'products', 'sectionData', 'selection'));
        }

        return redirect(route('palettes'));
    }

    public function saveSectionOrder(Request $request){
        $section = Section::where('id', $request->order_section_id)->where('palette_id',$request->order_palette_id)->first();
        $section->order = $request->new_order;
        $section->save();
        
        return redirect(route('editPalette', $request->order_palette_id));
    }
    //WEB FUNCTIONS FROM HERE

    public function showPalette($id){
        $palette = Palette::where('id', $id)->with('sections')->first();
        $sections = Section::where('palette_id', $id)->orderBy('order')->with('paletteSections')->get();
        $project = Project::where('id', $palette->project_id)->first();

        $all_products = Product::with('light_requirement')->with('foliage_color')->with('flower_color')->with('general_color')->with('categories')->with('product_image')->get();
        $cat_order = ['Groundcovers', 'Shrubs', 'Succulents', 'Others', 'Palms', 'Fruits', 'Fruit_Trees', 'Trees'];
       
        $sections = json_decode(json_encode($sections));
        return view('web.pages.showPalette', compact('palette', 'sections', 'cat_order', 'project', 'all_products'));
    }

    
    
    //Determines the general category of a product
    public function categorizeProduct($prod_id){
        $data = new DataController();
        $inner_data = $data->getProductFootprint();
        $datacat =$inner_data->category;

        $prod_cat = ProductCategory::where('product_id', $prod_id)->get();
        $prod_cat_only = [];
        foreach($prod_cat as $item){
            array_push($prod_cat_only, $item->category);
        }

        foreach($datacat as $testcat){
            if (in_array($testcat->db_name, $prod_cat_only)){
                return $testcat->parent;
            }
            
        }
        return "Others";
    }

    //THIS IS A ONE TIME FUCNTION TO MIGRATE SECTIONS DATA TO THE NWLY CREATED DATA. UMCOMMENT IF NEEDED, ELSE PRESERVE IT
    public function moveSectionsToNewTable(){
            // $allPalette = Palette::orderBy('created_at', 'asc')->get();
            // // return $allPalette;
            // foreach($allPalette as $palette){
            //     $allSections = Section::where('palette_id', $palette->id)->get();
    
            //     foreach($allSections as $section){
            //         $imgs_data =  explode(',', $section->image_ids);
    
            //         //Get each items product id and image id to save to the new table
            //         foreach($imgs_data as $data){
            //             $split_data = explode('_', $data);
            //             $prod_id = NULL;
            //             $img_id = NULL;
            //             if (count($split_data) > 1){
            //                 $prod_id = $split_data[0];
            //                 $img_id = $split_data[1];
            //             }
    
            //             if ($prod_id && $img_id){
            //                 $cat = $this->categorizeProduct($prod_id);
            //                 $pal_sect = new PaletteSection();
            //                 $pal_sect->section_id = $section->id;
            //                 $pal_sect->product_id = $prod_id;
            //                 $pal_sect->img_id = $img_id;
            //                 $pal_sect->override_category = $cat;
            //                 $pal_sect->save();
            //             }
            //         }
            //     }
            // }
            // return "Data moving Task complete";
        }
}




