@php
use App\Helpers\Helper;
$role = Helper::role_slug();
if ($role != 'admin' && $role != 'user' ){
  return redirect()->route('ingredient.index')->withErrors('You dont have permission to view this page!!');
}

@endphp


<x-app-layout>


   <form class="needs-validation" action="{{ route('ingredient.store') }}" method="POST" id="form_data" enctype="multipart/form-data" novalidate="">
        @csrf
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header pb-0">
                    <h5>Add ingredient</h5>
                </div>
                <div class="card-body">

                    <div class="row g-3">
                        <div class="col-md-4">
                             <label class="form-label">Ingredient Name</label>
                            <input class="form-control" id="ingredient_name" type="text" name="ingredient_name"
                                placeholder="Ingredient Name" value="{{ Request::old('ingredient_name') }}" required="">
                            <div class="invalid-feedback">Please Insert Unique Ingredient name</div>
                            @error('ingredient_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                             <label class="form-label">Name in Hindi</label>
                            <input class="form-control" id="ingredient_hindi" type="text" name="ingredient_hindi"
                                placeholder="Name in Hindi" value="{{ Request::old('ingredient_hindi') }}" required="">
                            <div class="invalid-feedback">Looks good!</div>
                            @error('ingredient_hindi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">known as</label>
                            <input class="form-control" id="known_as" name="known_as" type="text"
                                placeholder="known as" aria-describedby="inputGroupPrepend" value="{{ Request::old('known_as') }}" required="">
                            <div class="invalid-feedback">Please choose .</div>
                            @error('known_as')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                
                    <ul class="nav nav-tabs nav-primary" id="top-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i class="icofont icofont-ui-home"></i>Basic</a></li>
                        <li class="nav-item"><a class="nav-link" id="top-sugar-tab" data-bs-toggle="tab" href="#top-sugar" role="tab" aria-controls="top-profile" aria-selected="false"><i class="icofont icofont-man-in-glasses"></i>Sugar & Fat</a></li>
                        <li class="nav-item"><a class="nav-link" id="top-vitamins-tab" data-bs-toggle="tab" href="#top-vitamins" role="tab" aria-controls="top-contact" aria-selected="false"><i class="icofont icofont-contacts"></i>Vitamins & Minerals</a></li>
                        <li class="nav-item"><a class="nav-link" id="top-description-tab" data-bs-toggle="tab" href="#top-description" role="tab" aria-controls="top-description" aria-selected="false"><i class="icofont icofont-contacts"></i>Description</a></li>
                    </ul>

                    <div class="tab-content" id="top-tabContent">
                        <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                            
                            <div class="row g-3 pt-3">
                                <div class="col-md-3">
                                     <label class="form-label">Category</label>
                                    @if (!empty($categorylist))
                                        <select class="form-select" id="category" name="Category" required="">
                                            <option selected="" disabled="" value="">Category</option>
                                            @foreach ($categorylist as $category)
                                                <option value="{{ $category->id }}" {{ (Request::old('Category') == $category->id) ? 'selected' : ''  }} >{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <div class="invalid-feedback">Please select a valid Category.</div>
                                    @error('Category')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
            
            
            
                                <div class="col-md-3">
                                     <label class="form-label">Food Group</label>
                                    @if (!empty($foodgrouplist))
                                        <select class="form-select" id="food_group" name="food_group" required="">
                                            <option selected="" disabled="" value="">Food Group</option>
                                            @foreach ($foodgrouplist as $foodgroup)
                                                <option value="{{ $foodgroup->id }}" {{ (Request::old('food_group') == $foodgroup->id) ? 'selected' : ''  }} >{{ $foodgroup->name }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <div class="invalid-feedback">Please select a valid Food Group.</div>
                                    @error('food_group')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
            
            
            
            
                                <div class="col-md-2">
                                      <label class="form-label">slug</label>
                                    <input class="form-control" id="slug" type="text" name="slug" placeholder="slug" value="{{ Request::old('slug') }}"
                                        required="">
                                    <div class="invalid-feedback">Slug is required</div>
                                    @error('slug')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
            
                                <div class="col-md-2">
                                     <label class="form-label">Directly eatable</label>
                                    <select class="form-select" id="directly_eatable" name="directly_eatable" required="">
                                        <option selected="" disabled="" value="">Directly eatable</option>
                                        <option value="1"  {{ (Request::old('directly_eatable') == 1) ? 'selected' : ''  }}>yes</option>
                                        <option value="0" {{ (Request::old('directly_eatable') == 0) ? 'selected' : ''  }}>no</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a valid state.</div>
                                    @error('directly_eatable')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
            
            
            
                                <div class="col-md-2">
                                      <label class="form-label">Database(India,US,etc)</label>
                                    @if (!empty($mealdatabaselist))
                                        <select class="form-select" id="database" name="database" required="">
                                            <option value="">Database(India,US,etc)</option>
                                            @foreach ($mealdatabaselist as $mealdatabase)
                                                <option value="{{ $mealdatabase->id }}" {{ (Request::old('database') == $mealdatabase->id) ? 'selected' : ''  }} >{{ $mealdatabase->database_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <div class="invalid-feedback">Please select a valid state.</div>
                                    @error('database')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
            
                                <div class="col-md-6">
                                      <label class="form-label">How to store</label>
                                    <textarea class="form-control inline-editor" data-char="how_to_store_charNum" name="how_to_store" placeholder="How to store" id="how_to_store" rows="3">{{ Request::old('how_to_store') }}</textarea>
                                    
                                    <div id="how_to_store_charNum"></div>
                                    <div class="invalid-feedback">Looks good!</div>
                                    @error('how_to_store')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
            
                                <div class="col-md-6">
                                      <label class="form-label">Slug Life</label>
                                    <textarea class="form-control inline-editor" name="shelf_life" placeholder="Slug Life" id="shelf_life"
                                        rows="3">{{ Request::old('shelf_life') }}</textarea>

                                    <div id="shelf_life_charNum"></div>
                                    <div class="invalid-feedback">Looks good!</div>
                                    @error('shelf_life')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
            
            
            
            
                                @if (!empty($measurementlist))
                                    <div class="col-md-6">
                                        <label class="form-label">Select Measurement units</label>
                                        <select class="js-example-basic-multiple form-control"
                                            data-placeholder="Select Measurement units" name="Meserment[]" id="mesermentname"
                                            multiple="multiple">
                                            @foreach ($measurementlist as $measurement)
                                                <option value="{{ $measurement->id }}" >{{ $measurement->unit }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select a valid Food Group.</div>
                                        @error('Meserment')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif
            
            
            
                                @if (!empty($allergyCategorylist))
                                    <div class="col-md-6">
                                        <label class="form-label">Allergies if any</label>
                                        <select class="js-example-basic-multiple form-control" data-placeholder="Allergies if any"
                                            name="allergies[]" id="allergies" multiple="multiple">
                                            @foreach ($allergyCategorylist as $allergyCategory)
                                                @php
                                                $selected = '';
                                                if(!empty(Request::old('allergies'))){
                                                    if(in_array( $allergyCategory->id, Request::old('allergies'))) 
                                                    $selected = 'selected';
                                                }
                                                @endphp
                                                <option value="{{ $allergyCategory->id }}" {{ $selected  }}>{{ $allergyCategory->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select a valid Food Group.</div>
                                        @error('health_tag')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif
            
                                @if (!empty($ayurvedalist))
                                    <div class="col-md-3">
                                        <label class="form-label">Ayurveda</label>
                                        <select class="js-example-basic-multiple form-control" data-placeholder="Ayurveda"
                                            name="Ayurveda[]" id="Ayurveda" multiple="multiple">
                                            @foreach ($ayurvedalist as $ayurveda)
                                                @php
                                                $selected = '';
                                                if(!empty(Request::old('Ayurveda'))){
                                                    if(in_array( $ayurveda->id, Request::old('Ayurveda'))) 
                                                    $selected = 'selected';
                                                }
                                                @endphp
                                                <option value="{{ $ayurveda->id }}" {{ $selected }} >{{ $ayurveda->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select a valid Ayurveda.</div>
                                        @error('Ayurveda')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif
            
                                <div class="col-md-3">
                                    <label class="form-label">choose file</label>
                                    <input class="form-control" id="images" type="file" name="images"
                                        placeholder="choose file" value="" required="">
                                    <div class="invalid-feedback">Image is required</div>
                                    @error('images')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
            
            
                                @if (!empty($mealdiseaseslist))
                                    <div class="col-md-6">
                                           <label class="form-label">Avoid It</label>
                                        <select class="js-example-basic-multiple form-control" data-placeholder="Avoid It"
                                            name="avoidit[]" id="avoidit" multiple="multiple">
            
                                            @foreach ($mealdiseaseslist as $mealdiseases)
                                              @php
                                                $selected = '';
                                                if(!empty(Request::old('avoidit'))){
                                                    if(in_array( $mealdiseases->id, Request::old('avoidit'))) 
                                                    $selected = 'selected';
                                                }
                                                @endphp
                                                <option value="{{ $mealdiseases->id }}"{{$selected}} > {{ $mealdiseases->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select a valid Food Group.</div>
            
                                    </div>
                                @endif
            
            
                                <div class="card-header pb-0">
                                    <h5>Measurement </h5>
                                </div>
            
                                <div id="measurementlist"></div>
            
            
                                
                            </div>
                            
                        </div>
                        <div class="tab-pane fade" id="top-sugar" role="tabpanel" aria-labelledby="top-sugar-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-2">
                                            <label class="form-label">Gram</label>
                                            <input class="form-control" id="gram" type="number" name="gram" placeholder="Gram" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                             <label class="form-label">calories</label>
                                            <input class="form-control" id="calories" type="number" name="calories"
                                                placeholder="calories" min="0" step=".01" >
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                              <label class="form-label">Fat</label>
                                            <input class="form-control" id="fat" type="number" name="fat" placeholder="Fat" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                              <label class="form-label">carbs</label>
                                            <input class="form-control" id="carbs" type="number" name="carbs" placeholder="carbs" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">protein</label>
                                            <input class="form-control" id="protein" type="number" name="protein"
                                                placeholder="Protein" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                             <label class="form-label">Fiber</label>
                                            <input class="form-control" id="fiber" type="number" name="fiber" placeholder="Fiber" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                    </div>
                
                                    <div class="row g-3 pt-3">
                                        <div class="col-md-2">
                                             <label class="form-label">sodium</label>
                                            <input class="form-control" id="sodium" type="number" name="sodium" placeholder="sodium" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                             <label class="form-label">potassium</label>
                                            <input class="form-control" id="potassium" type="number" name="potassium"
                                                placeholder="potassium" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                             <label class="form-label">cholestrol</label>
                                            <input class="form-control" id="cholestrol" type="number" name="cholestrol"
                                                placeholder="cholestrol" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                               <label class="form-label">water%</label>
                                            <input class="form-control" id="water" type="number" name="water" placeholder="water%" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                             <label class="form-label">yeild</label>
                                            <input class="form-control" id="yeild" type="number" name="yeild" placeholder="yeild" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                               <label class="form-label">sugar</label>
                                            <input class="form-control" id="sugar" type="number" name="sugar" placeholder="sugar" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                    </div>
                
                
                                    <div class="card-header pb-0">
                                        <h5>Sugar</h5>
                                    </div>
                
                                    <div class="row g-3 pt-3">
                                        <div class="col-md-2">
                                               <label class="form-label">sugar G</label>
                                            <input class="form-control" id="sugar_G" type="number" name="sugar_G"
                                                placeholder="sugar G" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">sucrose (G)</label>
                                            <input class="form-control" id="sucrose_G" type="number" name="sucrose_G"
                                                placeholder="sucrose (G)" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                             <label class="form-label">Gulcose (G)</label>
                                            <input class="form-control" id="gulcose_g" type="number" name="gulcose_g"
                                                placeholder="Gulcose (G)" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                              <label class="form-label">Fructose(G)</label>
                                            <input class="form-control" id="fructose_g" type="number" name="fructose_g"
                                                placeholder="Fructose(G)" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                              <label class="form-label">Lactose(G)</label>
                                            <input class="form-control" id="lactose_g" type="number" name="lactose_g"
                                                placeholder="Lactose(G)" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                                  <label class="form-label">Maltose(G)</label>
                                            <input class="form-control" id="maltose_g" type="number" name="maltose_g"
                                                placeholder="Maltose(G)" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                    </div>
                
                
                                    <div class="row g-3 pt-3">
                                        <div class="col-md-2">
                                            <label class="form-label">Galactose(G)</label>
                                            <input class="form-control" id="galactose_g" type="number" name="galactose_g"
                                                placeholder="Galactose(G)" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                
                                    </div>
                
                                    <div class="card-header pb-0">
                                        <h5>Fat</h5>
                                    </div>
                
                                    <div class="row g-3 pt-3">
                
                                        <div class="col-md-2">
                                              <label class="form-label">Saturated_FAT</label>
                                            <input class="form-control" id="saturated_fat" type="number" name="saturated_fat"
                                                placeholder="Saturated_FAT" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                             <label class="form-label">Monounsaturated</label>
                                            <input class="form-control" id="monounsaturated" type="number" name="monounsaturated"
                                                placeholder="Monounsaturated" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                               <label class="form-label">Polyunsaturated</label>
                                            <input class="form-control" id="polyunsaturated" type="number" name="polyunsaturated"
                                                placeholder="Polyunsaturated" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                              <label class="form-label">Trans FAT</label>
                                            <input class="form-control" id="trans_fat" type="number" name="trans_fat"
                                                placeholder="Trans FAT" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                                <label class="form-label">Omega 3 Fatty</label>
                                            <input class="form-control" id="omega_3_fatty" type="number" name="omega_3_fatty"
                                                placeholder="Omega 3 Fatty" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                    </div>
                
                
                                    <div class="row g-3 pt-3">
                                        <div class="col-md-2">
                                            <label class="form-label">Omega 6 Fatty</label>
                                            <input class="form-control" id="omega_6_fatty" type="number" name="omega_6_fatty"
                                                placeholder="Omega 6 Fatty" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                    </div>
                
            
                
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="top-vitamins" role="tabpanel" aria-labelledby="top-vitamins-tab">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h3>Vitamins & Minerals</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-2">
                                            <label class="form-label">Betaine(MG)</label>
                                            <input class="form-control" id="betaine" type="number" name="betaine"
                                                placeholder="Betaine(MG)" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                               <label class="form-label">Calcium(MG)</label>
                                            <input class="form-control" id="calcium" type="number" name="calcium"
                                                placeholder="Calcium(MG)" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                              <label class="form-label">Copper(MG)</label>
                                            <input class="form-control" id="copper" type="number" name="copper"
                                                placeholder="Copper(MG)" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Folate(MG)</label>
                                            <input class="form-control" id="folate" type="number" name="folate"
                                                placeholder="Folate(MG)" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                                <label class="form-label">Lycopene(MG)</label>
                                            <input class="form-control" id="lycopene" type="number" name="lycopene"
                                                placeholder="Lycopene(MG)" min="0" step=".01">
                                            <div class="valid-feedback">!</div>
                                        </div>
                                        <div class="col-md-2">
                                               <label class="form-label">Manganese(MG)</label>
                                            <input class="form-control" id="manganese" type="number" name="manganese"
                                                placeholder="Manganese(MG)" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                    </div>
                
                                    <div class="row g-3 pt-3">
                                        <div class="col-md-2">
                                            <label class="form-label">Phosphorus</label>
                                            <input class="form-control" id="phosphorus" type="number" name="phosphorus"
                                                placeholder="Phosphorus" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                              <label class="form-label">Reboflavin</label>
                                            <input class="form-control" id="reboflavin" type="number" name="reboflavin"
                                                placeholder="Reboflavin" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                             <label class="form-label">Vitamin A</label>
                                            <input class="form-control" id="vitamin_a" type="number" name="vitamin_a"
                                                placeholder="Vitamin A" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                             <label class="form-label">Vitamin B6</label>
                                            <input class="form-control" id="vitamin_b6" type="number" name="vitamin_b6"
                                                placeholder="Vitamin B6" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                              <label class="form-label">Vitamin C</label>
                                            <input class="form-control" id="vitamin_c" type="number" name="vitamin_c"
                                                placeholder="Vitamin C" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                             <label class="form-label">Vitamin D2</label>
                                            <input class="form-control" id="vitamin_d2" type="number" name="vitamin_d2"
                                                placeholder="Vitamin D2" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                    </div>
                
                                    <div class="row g-3 pt-3">
                                        <div class="col-md-2">
                                              <label class="form-label">Vitamin D3</label>
                                            <input class="form-control" id="vitamin_d3" type="number" name="vitamin_d3"
                                                placeholder="Vitamin D3" min="0" step=".01">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                             <label class="form-label">Vitamin E</label>
                                            <input class="form-control" id="vitamin_e" type="number" name="vitamin_e"
                                                placeholder="Vitamin E" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                              <label class="form-label">Vitamin B12</label>
                                            <input class="form-control" id="vitamin_b12" type="number" name="vitamin_b12"
                                                placeholder="Vitamin B12" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                             <label class="form-label">Vitamin K</label>
                                            <input class="form-control" id="vitamin_k" type="number" name="vitamin_k"
                                                placeholder="Vitamin K" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                             <label class="form-label">Choline</label>
                                            <input class="form-control" id="choline" type="number" name="choline"
                                                placeholder="Choline" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                               <label class="form-label">Fluoride</label>
                                            <input class="form-control" id="fluride" type="number" name="fluride"
                                                placeholder="Fluoride" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                    </div>
                
                
                                    <div class="row g-3 pt-3">
                                        <div class="col-md-2">
                                             <label class="form-label">Iron</label>
                                            <input class="form-control" id="iron" type="number" name="iron" placeholder="Iron" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                              <label class="form-label">Magnesium</label>
                                            <input class="form-control" id="magnesium" type="number" name="magnesium"
                                                placeholder="Magnesium" min="0" step=".01">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                             <label class="form-label">Niacin</label>
                                            <input class="form-control" id="niacin" type="number" name="niacin" placeholder="Niacin" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Retinol</label>
                                            <input class="form-control" id="retinol" type="number" name="retinol"
                                                placeholder="Retinol" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                             <label class="form-label">Thiamine</label>
                                            <input class="form-control" id="thiamine" type="number" name="thiamine"
                                                placeholder="Thiamine" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                              <label class="form-label">Selenium</label>
                                            <input class="form-control" id="selenium" type="number" name="selenium"
                                                placeholder="Selenium" min="0" step=".01">
                                            <div class="valid-feedback"></div>
                                        </div>
                                    </div>
                
                
                                    <div class="row g-3 pt-3">
                                        <div class="col-md-2">
                                             <label class="form-label">Zinc</label>
                                            <input class="form-control" id="zinc" type="number" name="zinc" placeholder="Zinc" min="0" step=".01" value="{{ Request::old('zinc') }}">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                               <label class="form-label">Vitamin D</label>
                                            <input class="form-control" id="vitamin_d" type="number" name="vitamin_d"
                                                placeholder="Vitamin D"  min="0" step=".01" value="{{ Request::old('vitamin_d') }}">
                                            <div class="valid-feedback"></div>
                                        </div>
                                        <div class="col-md-2">
                                             <label class="form-label">Caffeine</label>
                
                                            <input class="form-control" id="caffeine" type="number" name="caffeine"
                                                placeholder="Caffeine" min="0" step=".01" value="{{ Request::old('caffeine') }}">
                
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="top-description" role="tabpanel" aria-labelledby="top-description-tab">


                            <div class="card-body">
                                <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                                  <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-longDesc" role="tab" aria-controls="top-home" aria-selected="true"><i class="icofont icofont-ui-home"></i>Long Description</a></li>
                                  <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-shortDesc" role="tab" aria-controls="top-profile" aria-selected="false"><i class="icofont icofont-man-in-glasses"></i>Short Description</a></li>
                
                                </ul>
                                
                                <div class="tab-content" id="top-tabContent">
                                  <div class="tab-pane fade show active" id="top-longDesc" role="tabpanel" aria-labelledby="top-home-tab">
                                    <textarea class="editable" id="long_desc" name="long_desc"></textarea>
                                    <div id="long_desc_charNum"></div>
                                  </div>
                                  <div class="tab-pane fade" id="top-shortDesc" role="tabpanel" aria-labelledby="profile-top-tab">
                                    <textarea id="short_desc" class="editable" name="short_desc"></textarea>
                                    <div id="short_desc_charNum"></div>
                                  </div>
                                </div>
                            </div>

                             
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                  </div>
            </div>

            
        
        </div>



        </div>

    </form>

    @push('extra_script')
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/simple-mde.css') }}">
        <script src="{{ asset('assets/js/editor/simple-mde/simplemde.min.js') }}"></script> --}}

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/summernote.css') }}">
        <script src="{{ asset('assets/js/jquery.ui.min.js') }}"></script>
        <script src="{{ asset('assets/js/editor/summernote/summernote.js') }}"></script>
        <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>

        <script src="{{ asset('assets/js/editor/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/js/editor/ckeditor/adapters/jquery.js') }}"></script>
        <script src="{{ asset('assets/js/editor/ckeditor/styles.js') }}"></script>

        

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
        <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>

        <script type="text/javascript">

            var editor = CKEDITOR.replaceAll( 'editable', {
                uiColor: '#CCEAEE',
            });
            //$(document.body).on("keyup", ".inline-editor", function(e) {
            $('.inline-editor').keyup(function(e) {
                currentLength = $(this).val().length;
                $('#'+ $(this).attr('id') + '_charNum').text(currentLength + ' Chars');
            });
               
           
            // var summernote_custom = {
            //     init: function() {
            //         $('.inline-editor').summernote({
            //             height: 100,
            //             toolbar: false,
            //             inheritPlaceholder: true,
            //             callbacks: {
            //                 onKeydown: function (e) { 
            //                     var t = e.currentTarget.innerText; 
            //                     // if (t.trim().length >= 400) {
            //                     //     //delete keys, arrow keys, copy, cut, select all
            //                     //     if (e.keyCode != 8 && !(e.keyCode >=37 && e.keyCode <=40) && e.keyCode != 46 && !(e.keyCode == 88 && e.ctrlKey) && !(e.keyCode == 67 && e.ctrlKey) && !(e.keyCode == 65 && e.ctrlKey))
            //                     //     e.preventDefault(); 
            //                     // } 
            //                 },
            //                 onKeyup: function (e) {
            //                     var t = e.currentTarget.innerText;
            //                     console.log();
            //                     $('#'+ $(this).attr('id') + '_charNum').text(t.trim().length + ' Chars');
            //                 },
            //                 onPaste: function (e) {
            //                     var t = e.currentTarget.innerText;
            //                     var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
            //                     e.preventDefault();
            //                     var maxPaste = bufferText.length;
            //                     // if(t.length + bufferText.length > 400){
            //                     //     maxPaste = 400 - t.length;
            //                     // }
            //                     if(maxPaste > 0){
            //                         document.execCommand('insertText', false, bufferText.substring(0, maxPaste));
            //                     }
            //                     $('#'+ $(this).attr('id') + '_charNum').text(t.length + ' Chars');
            //                 }
            //             }
            //         });
                    
            //     }
            // };
            // (function($) {
            //     "use strict";
            //     summernote_custom.init();
            // })(jQuery);

            var slug = function(str) {
                str = str.replace(/^\s+|\s+$/g, ''); // trim
                str = str.toLowerCase();

                // remove accents, swap ñ for n, etc
                var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
                var to = "aaaaaeeeeeiiiiooooouuuunc------";
                for (var i = 0, l = from.length; i < l; i++) {
                    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                }

                str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                    .replace(/\s+/g, '-') // collapse whitespace and replace by -
                    .replace(/-+/g, '-'); // collapse dashes

                return str;
            };
            $(document.body).on("change", "#ingredient_name", function() {
                $("#slug").val(slug($(this).val()));
            });

            $(document).ready(function() {
                 $('.js-example-basic-multiple').select2({
                    allowClear: true,
                 });

             }); 




            $('#mesermentname').on('select2:select', function(e) {
                var dparams = e.params.data;
                // var ing_id = dparams.id;

                var html = '<div class="row g-3 pt-3" id="mesure_' + dparams.id + '">' +
                    '<div class="col-md-2">' +
                    '  <input class="form-control" id="mesure_unit" type="hidden" name="mesure_unit[]" disable value="' +
                    dparams.id + '" >' + dparams.text +
                    '   <div class="invalid-feedback">mesurment name required</div>' +
                    '</div>' +
                    '<div class="col-md-2">' +
                    '  <input class="form-control" id="mesure_value" type="number" name="mesure_value[]" placeholder="value" required>' +
                    '  <div class="invalid-feedback">Field is required</div>' +
                    '</div>' +

                    '<div class="col-md-2">' +
                    '  <input class="form-control" id="price" type="number" name="price[]" placeholder="Price" required>' +
                    '  <div class="invalid-feedback">Field is required</div>' +
                    '</div>' +
                    '</div>';

                $('#measurementlist').append(html);


            });


            $('#mesermentname').on('select2:unselect', function(e) {
                var dparams = e.params.data;
                $('#measurementlist').find('#mesure_' + dparams.id).remove();
            });
            
            $(function(){
                $('#ingredient_name').on('change', function() {
                    var ingredient = $(this).val();
                    var data = {
                        'ingredient': ingredient
                    };
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:"{{route('ingredient.check')}}",
                        method:"POST",
                        data:data,
                        dataType: 'json',
                        success:function(result){
                            if(result.status =='0'){
                                $('#ingredient_name').removeClass('is-valid');
                                $('#ingredient_name').addClass('is-invalid');
                               
                            } else{
                                $('#ingredient_name').removeClass('is-invalid');
                                $('#ingredient_name').addClass('is-valid');
                                
                            }
                        }
                    });
                });
            });
        
            "use strict";
             (function() {
                 'use strict';
                 1
                 window.addEventListener('load', function() {
                     var forms = document.getElementsByClassName('needs-validation');
                     var validation = Array.prototype.filter.call(forms, function(form) {
                         form.addEventListener('submit', function(event) {

                             if (form.checkValidity() === false) {
                                 event.preventDefault();
                                 event.stopPropagation();
                             }
                             form.classList.add('was-validated');
                         }, false);
                     });
                 }, false);
             })();
        </script>
    @endpush



</x-app-layout>
