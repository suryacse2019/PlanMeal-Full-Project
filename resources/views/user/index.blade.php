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
                    <h5> List User</h5>
                    <span></span>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>NAME</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($userlist as $user)
                          <tr>
                              <td>{{$user->name}}</td>
                              <td>{{$user->email}}</td>
                              <td>{{$user->role->role_name}}</td>
                              <td>{{$user->status==1?'Active':'Inactive'}}</td>

                              
                              <td class="text-center">
                                @if($role == 'admin')
                                <a href="{{url('user/'.$user->id.'/edit')}}" class="btn btn-sm btn-warning">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                  <form action="{{url('user/'.$user->id)}}" method="POST">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm ('Are you sure you want to delete')"><i class="fa fa-trash" aria-hidden="true"></i></button> 
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
 <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
    <script src="{{asset('assets/js/tooltip-init.js')}}"></script>


@endpush

</x-app-layout>