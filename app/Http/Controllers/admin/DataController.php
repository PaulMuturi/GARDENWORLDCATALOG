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
                    'db_name' => 'low',
                    'parent' => 'Full shade'
                ],

                [
                    'display_name' => 'Full Shade',
                    'db_name' => 'full_shade',
                    'parent' => 'Full shade'
                ],
                [
                    'display_name' => 'Partial Shade',
                    'db_name' => 'partial_shade',
                    'parent' => 'Partial shade'
                ],
                [
                    'display_name' => 'Bright indirect sun',
                    'db_name' => 'bright_indirect_sun',
                    'parent' => 'Partial shade'
                ],
                [
                    'display_name' => 'Dappled',
                    'db_name' => 'dappled',
                    'parent' => 'Partial Shade'
                ],
                [
                    'display_name' => 'Full sun',
                    'db_name' => 'full_sun',
                    'parent' => 'Full sun'
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
                    'display_name' => 'Golden',
                    'db_name' => 'golden'
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
                    'display_name' => 'Pink',
                    'db_name' => 'pink'
                ],
                [
                    'display_name' => 'Purple',
                    'db_name' => 'purple'
                ],
                [
                    'display_name' => 'Bronze',
                    'db_name' => 'bronze'
                ],
                [
                    'display_name' => 'Lavender',
                    'db_name' => 'lavender'
                ],
                
                [
                    'display_name' => 'Apricot',
                    'db_name' => 'apricot'
                ],
                [
                    'display_name' => 'Grey',
                    'db_name' => 'grey'
                ],
                [
                    'display_name' => 'Variegated',
                    'db_name' => 'variegated'
                ],
            ],

            'main_category' => [
                [
                    'display_name' => 'Plants',
                    'db_name' => 'plants',
                ],
                [
                    'display_name' => 'Potted plants',
                    'db_name' => 'potted_plants',
                ],
                [
                    'display_name' => 'Pots & Containers',
                    'db_name' => 'pots_containers',
                ],
                [
                    'display_name' => 'Inputs',
                    'db_name' => 'inputs',
                ],
                [
                    'display_name' => 'Tools',
                    'db_name' => 'tools',
                ],
            ],

            
            'category' => [
                [
                    'display_name' => 'Grass',
                    'db_name' => 'grass',
                    'parent' => 'Groundcovers'
                ],
                [
                    'display_name' => 'Groundcover',
                    'db_name' => 'groundcover',
                    'parent' => 'Groundcovers'
                ],
                
                [
                    'display_name' => 'Short shrub',
                    'db_name' => 'short_shrub',
                    'parent' => 'Shrubs'
                ],
                [
                    'display_name' => 'Medium shrub',
                    'db_name' => 'medium_shrub',
                    'parent' => 'Shrubs'
                ],
                [
                    'display_name' => 'Tall shrub',
                    'db_name' => 'tall_shrub',
                    'parent' => 'Shrubs'
                ],
                [
                    'display_name' => 'Palm',
                    'db_name' => 'palm',
                    'parent' => 'Palms'
                ],
                [
                    'display_name' => 'Palm-Like',
                    'db_name' => 'palmlike',
                    'parent' => 'Palms'
                ],
                [
                    'display_name' => 'Fruit',
                    'db_name' => 'fruit',
                    'parent' => 'Fruits'
                ],
                [
                    'display_name' => 'Fruit tree',
                    'db_name' => 'fruit_tree',
                    'parent' => 'Fruit_Trees'
                ],
                [
                    'display_name' => 'Succulent',
                    'db_name' => 'succulent',
                    'parent' => 'Succulents'
                ],
                [
                    'display_name' => 'Climber',
                    'db_name' => 'climber',
                    'parent' => 'Groundcovers'
                ],
                
                [
                    'display_name' => 'Tree',
                    'db_name' => 'tree',
                    'parent' => 'Trees'
                ],
                [
                    'display_name' => 'Upright Growing Screen Tree',
                    'db_name' => 'upright_growing_screen_tree',
                    'parent' => 'Trees'
                ],
                [
                    'display_name' => 'Foliage plant',
                    'db_name' => 'foliage_plant',
                    'parent' => 'Others'
                ],
                                
                [
                    'display_name' => 'Herb',
                    'db_name' => 'herb',
                    'parent' => 'Herbs'
                ],
                [
                    'display_name' => 'Herbaceous plant',
                    'db_name' => 'herbaceous_plant',
                    'parent' => 'Others'
                ],
                [
                    'display_name' => 'Fern',
                    'db_name' => 'fern',
                    'parent' => 'Others'
                ],
                
                
                [
                    'display_name' => 'Other',
                    'db_name' => 'other',
                    'parent' => 'Others'
                ],
            ],

            'gardentype' => [
                [
                    'display_name' => 'Tropical Gardens',
                    'db_name' => 'tropical',
                ],
                [
                    'display_name' => 'Herbs Gardens',
                    'db_name' => 'herbs',
                ],
                [
                    'display_name' => 'Mediterranean Gardens',
                    'db_name' => 'mediterranean',
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
