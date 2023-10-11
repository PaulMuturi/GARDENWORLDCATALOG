@extends('admin.app')

@section ('main-content')
    <section class="container">
        <h2 class="text-success">ADD ITEM</h2>
       
        <form action="" method="" class="row bg-light p-2">
            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">*Botanical name</label>
                    <input type="text" id="botanical_name" class="form-control">
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">*Common name</label>
                    <input type="text" id="common_name" class="form-control">
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">*Category</label>
                    <select name="category" id="category" class="form-control">
                        <option value="none">None selected</option>
                        @foreach($plant_fp->category as $cat)
                            <option value="{{$cat->db_name}}">{{$cat->display_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">*Image</label>
                    <input type="file" class="form-control">
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">*Selling price (Ksh)</label>
                    <input type="number" class="form-control">
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">*Max discounted price (Ksh)</label>
                    <input type="number" class="form-control">
                </div>
            </div>
            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Stocked amount</label>
                    <div class="d-flex">
                        <input type="number" min="0" name="stocked_amount" class="no_border_rounded">
                        <select name="stocked_amount_units" id="stocked_amount_units" class="">
                            <option value="no">No.</option>
                            <option value="bags">Bags</option>
                            <option value="sqm">SQM</option>
                            <option value="ton">Ton</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Notes</label>
                    <textarea name="notes" id="notes" rows="3" class="form-control"></textarea>
                </div>
            </div>

            <div class="col-md-6 field_item">
                <input type="submit" value="SAVE" class="btn btn-warning">
            </div>
            
            <hr class="mt-3 text-success">
            <h4 class="text-success">FOR PLANTS</h4>
            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Foliage color</label>
                    <select name="foliage_color" id="foliage_color" class="form-control">
                        <option value="none">None selected</option>
                        @foreach($plant_fp->foliage_color as $color)
                            <option value="{{$color->db_name}}">{{$color->display_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Flower color</label>
                    <select name="flower_color" id="flower_color" class="form-control">
                        <option value="none">None selected</option>
                        @foreach($plant_fp->flower_color as $color)
                            <option value="{{$color->db_name}}">{{$color->display_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Maintenance</label>
                    <select name="maintenance" id="maintenance" class="form-control">
                        <option value="none">None selected</option>
                        @foreach($plant_fp->maintenance as $maintenance)
                            <option value="{{$maintenance->db_name}}">{{$maintenance->display_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

             <!-- Field -->
             <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Planting interval</label>
                    <div class="d-flex">
                            <input type="number" name="planting_interval" class="no_border_rounded">
                            <select name="planting_interval_units" id="planting_interval_units" class="">
                                <option value="mm">mm</option>
                                <option value="mm">cm</option>
                                <option value="ft">ft</option>
                            </select>
                    </div>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Mature spread</label>
                    <div class="d-flex">
                        <input type="number" name="mature_spread" class="no_border_rounded">
                        <select name="mature_spread_units" id="mature_spread_units" class="">
                            <option value="mm">mm</option>
                            <option value="mm">cm</option>
                            <option value="ft">ft</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Mature height</label>
                    <div class="d-flex">
                        <input type="number" name="mature_height" class="no_border_rounded">
                        <select name="mature_height_units" id="mature_height_units" class="">
                            <option value="mm">mm</option>
                            <option value="mm">cm</option>
                            <option value="ft">ft</option>
                        </select>
                    </div>
                </div>
            </div>

             <!-- Field -->
             <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Light requirements</label>
                    <div class="d-flex">
                        @foreach($plant_fp->light_requirements as $req)
                            <label class="border p-2"><span>{{$req->display_name}}</span> <input type="checkbox" value="{{$req->db_name}}" name="light_requirements[]" class="no_border_rounded"></label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Water requirements</label>
                    <div class="d-flex">
                        @foreach($plant_fp->water_requirements as $req)
                            <label class="border p-2"><span>{{$req->display_name}}</span> <input type="checkbox" value="{{$req->db_name}}" name="water_requirements[]" class="no_border_rounded"></label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Toxicity to humans</label>
                    <select name="toxicity_to_humans" id="toxicity_to_humans" class="form-control">
                        @foreach($plant_fp->toxicity as $level)
                            <option value="{{$level->db_name}}">{{$level->display_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Toxicity to pets</label>
                    <select name="toxicity_to_pets" id="toxicity_to_pets" class="form-control">
                        @foreach($plant_fp->toxicity as $level)
                            <option value="{{$level->db_name}}">{{$level->display_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <input type="submit" value="SAVE" class="btn btn-warning">
            </div>

        </form> 
    </section>
@endsection