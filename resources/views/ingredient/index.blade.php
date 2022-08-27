@php
use App\Helpers\Helper;
$role = Helper::role_slug();
@endphp
<x-app-layout>


    <div class="col-sm-12">
        <div class="card">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-header">
                <h5>Ingredient List</h5>
                <span></span>
            </div>
            @if ($role == 'user' || $role == 'admin')
                <a href="{{ route('ingredient.create')}}">
                    <button class="pull-right btn btn-primary" name="add_ingredient">ADD Ingredient</button>
                </a>
            @endif

            <form action="{{ route('ingredient.index')}}" method="get" name="formFilter">
                <div class="card-body">
                    <label class="form-label">Filter By</label>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <select class="form-select" id="filterBy" name="filterBy" required="">
                                <option selected="" disabled="" value="">Select a filter</option>
                                <option value="1" {{ ($search_term['filterBy']== 1)? 'selected' : ''}} >Ingredient Name</option>
                                <option value="2" {{ ($search_term['filterBy']== 2)? 'selected' : ''}} >Category Name</option>
                                {{-- <option value="3" {{ ($search_term['filterBy']== 3)? 'selected' : ''}} >Measurement</option>
                                <option value="4" {{ ($search_term['filterBy']== 4)? 'selected' : ''}} >Ayurveda</option> --}}
                                {{-- <option value="6" {{ ($search_term['filterBy']== 6)? 'selected' : ''}} >Section</option> --}}
                            </select>

                        </div>
                        <div class="col-md-3" id="subFilterSection">
                            <select class="form-select" name="subFilter" id="subFilter" onchange="this.form.submit()">
                                @if($search_term['subFilter'])
                                    @foreach($subFilterAry as $key=>$value)
                                        <option value="{{ $value['id']}}" {{ ($search_term['subFilter']== $value['id'])? 'selected' : ''}}>{{ $value['name']}}</option>
                                    @endforeach
                                @endif

                            </select>
                        </div>

                        
                    </div>
                </div>
            </form>

          <div class="card-body">
              <div class="table-responsive">
                  <table class="display" id="basic-1">
                      <thead>
                          <tr>
                              <th>Ingredient</th>
                              <th>Energy</th>
                              <th>Carbs</th>
                              <th>Measurement</th>
                              <th>Category</th>
                              <th>Ayurveda</th>
                              <th>Dishes</th>
                              <th>SEO</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($ingredient as $ingd)
                              <tr>
                                  <td>{{ $ingd->name }}</td>

                                  <td>{{ $ingd->calories }}</td>

                                  <td>{{ $ingd->carbs }}</td>

                                  <td>
                                      {{ $ingd->unit_name }}
                                  </td>

                                  <td>{{ $ingd->categoryName->name }}</td>

                                  <td>{{ $ingd->ayurveda_type }}</td>

                                  <td>{{$ingd->recipeCount}}</td>
                                  <td>{{$ingd->otherseo}}</td>

                                  <td class="text-center">

                                      <a href="{{ url('ingredient/' . $ingd->id . '/edit') }}">
                                          <i class="fa fa-edit"></i>
                                      </a>
                                      @if ($role != 'viewer' && $role != 'content-editor' && $role != 'nutrient' && $role != 'user')
                                          <form action="{{ route('ingredient.destroy',$ingd->id) }}" method="POST">
                                              @csrf
                                              {{ method_field('DELETE') }}
                                              <button type="submit" class="btn btn-danger btn-sm"
                                                  onclick="return confirm ('Are you sure you want to delete')"><i
                                                      class="fa fa-trash" aria-hidden="true"></i></button>
                                          </form>
                                      @endif
                                  </td>

                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
        </div>
    </div>
    <!-- Zero Configuration  Ends-->


    @push('extra_script')
        <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
        <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
        <script type="text/javascript">
            $('#filterBy').on('change', function() {
                var filterid = $(this).find(':selected').val();
                $("#subFilter").empty();
                var data = {
                    'filterid': filterid
                };
    
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('getIngredientFilter') }}",
                    data: data,
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(index, value) {
                            $('#subFilter').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }
                });
            });
    
            </script>
    @endpush

</x-app-layout>
