<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataController extends Controller
{
    
    public function getProductFootprint(){
        $data = [
            'light_requirements' => [
                [
                    'display_name' => 'Low',
                    'db_name' => 'low'
                ],

                [
                    'display_name' => 'Full Shade',
                    'db_name' => 'full_shade'
                ],
                [
                    'display_name' => 'Partial Shade',
                    'db_name' => 'partial_shade'
                ],
                [
                    'display_name' => 'Bright indirect sun',
                    'db_name' => 'bright_indirect_sun'
                ],
                [
                    'display_name' => 'Dappled',
                    'db_name' => 'dappled'
                ],
                [
                    'display_name' => 'Full sun',
                    'db_name' => 'full_sun'
                ],
            ],

            'water_requirements' => [
                [
                    'display_name' => 'Low',
                    'db_name' => 'low'
                ],

                [
                    'display_name' => 'Average',
                    'db_name' => 'average'
                ],
                [
                    'display_name' => 'High',
                    'db_name' => 'high'
                ],
                [
                    'display_name' => 'Bog',
                    'db_name' => 'bog'
                ],
            ],

            'colors' => [
                [
                    'display_name' => 'Green',
                    'db_name' => 'green'
                ],
                [
                    'display_name' => 'White',
                    'db_name' => 'white'
                ],
                [
                    'display_name' => 'Yellow',
                    'db_name' => 'yellow'
                ],
                [
                    'display_name' => 'Orange',
                    'db_name' => 'orange'
                ],
                [
                    'display_name' => 'Red',
                    'db_name' => 'red'
                ],
                [
                    'display_name' => 'Blue',
                    'db_name' => 'blue'
                ],
                [
                    'display_name' => 'Purple',
                    'db_name' => 'purple'
                ],
                [
                    'display_name' => 'Lavender',
                    'db_name' => 'lavender'
                ],
                [
                    'display_name' => 'Pink',
                    'db_name' => 'pink'
                ],
                [
                    'display_name' => 'Apricot',
                    'db_name' => 'apricot'
                ],
                [
                    'display_name' => 'Grey',
                    'db_name' => 'grey'
                ],
            ],

            
            'category' => [
                [
                    'display_name' => 'Grass',
                    'db_name' => 'grass'
                ],
                [
                    'display_name' => 'Groundcover',
                    'db_name' => 'groundcover'
                ],
                [
                    'display_name' => 'Herbaceous plant',
                    'db_name' => 'herbaceous_plant'
                ],
                [
                    'display_name' => 'Foliage plant',
                    'db_name' => 'foliage_plant'
                ],
                [
                    'display_name' => 'Short shrub',
                    'db_name' => 'short_shrub'
                ],
                [
                    'display_name' => 'Medium shrub',
                    'db_name' => 'medium_shrub'
                ],
                [
                    'display_name' => 'Tall shrub',
                    'db_name' => 'tall_shrub'
                ],
                [
                    'display_name' => 'Palm',
                    'db_name' => 'palm'
                ],
                [
                    'display_name' => 'Fern',
                    'db_name' => 'fern'
                ],
                [
                    'display_name' => 'Tree',
                    'db_name' => 'tree'
                ],
                [
                    'display_name' => 'Fruit',
                    'db_name' => 'fruit'
                ],
                [
                    'display_name' => 'Fruit tree',
                    'db_name' => 'fruit_tree'
                ],
                [
                    'display_name' => 'Herb',
                    'db_name' => 'herb'
                ],
                [
                    'display_name' => 'Climber',
                    'db_name' => 'climber'
                ],
                
                [
                    'display_name' => 'Succulent',
                    'db_name' => 'succulent'
                ],
                [
                    'display_name' => 'Other',
                    'db_name' => 'other'
                ],
            ],

            'maintenance' => [
                [
                    'display_name' => 'Low',
                    'db_name' => 'low'
                ],
                [
                    'display_name' => 'Average',
                    'db_name' => 'average'
                ],
                [
                    'display_name' => 'High',
                    'db_name' => 'high'
                ],
            ],

            'toxicity' => [
                [
                    'display_name' => 'None',
                    'db_name' => 'none'
                ],
                [
                    'display_name' => 'Mild',
                    'db_name' => 'mild'
                ],
                [
                    'display_name' => 'Abit Lethal',
                    'db_name' => 'abit_lethal'
                ],
                [
                    'display_name' => 'Very Lethal',
                    'db_name' => 'very_lethal'
                ],
            ],
        ];

        //encodes the array into string then decodes it into json object
        $data = json_decode(json_encode($data));
        return $data;
    }
}
