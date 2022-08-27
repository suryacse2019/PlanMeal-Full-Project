<x-app-layout>

                  <form class="card" action="{{ route('user.update',$user->id) }}" method="POST">
                     @csrf
                    {{method_field('PUT')}}
                    <div class="card-header pb-0">
                      <h4 class="card-title mb-0">Edit Profile</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label"> Name</label>
                            <input class="form-control" id="name" name="name" type="text" placeholder="Name"  value="{{ $user->name }}">
                          </div>
                        </div>

                        
                        <div class="col-sm-5 col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input class="form-control" id="email" name="email" type="email" placeholder="Email"  value="{{ $user->email }}">
                          </div>
                        </div>
                        
                          <div class="col-sm-5 col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input class="form-control" id="password" name="Password" type="password" placeholder="Password"  value="{{ $user->password }}">
                          </div>
                        </div>

                              <div class="col-md-5 col-md-4">
                                 <div class="mb-3">
                                  @if(!empty($rolelist))
                                    <label class="form-label">Role</label>  
                                <select class="form-select" id="role" name="role" required="">
                                  <option selected="" disabled="" >Role</option>
                                  @foreach($rolelist as $role)
                                 @php
                                    $selected = '';
                                    if($role->id == $user->role_id) {
                                    $selected = 'selected';
                                      }
                                                    
                                  @endphp
                                <option value="{{$role->id}}" {{ $selected }}>{{ $role->role_name }}</option>

                                @endforeach
                                  </select>
                                 @endif
                                  </div>
                                  </div>

                              <div class="col-md-5 mb-4">
                              	 <div class="mb-3">
                              	    <label class="form-label">status</label>	
                                <select class="form-select" id="status" name="status" required="">
                                  <option selected="" disabled="" value="">status</option>
                                   <option value= "1" {{ $user->status == '1' ? 'selected' : '' }}>Active</option>
                                   <option value= "0" {{ $user->status == '0' ? 'selected' : '' }}>Inactive</option>

                                </select>
                            </div>
    
		                        </div>
		                      </div>
		                    </div>
		                    <div class="card-footer text-end">
		                      <button class="btn btn-primary" type="submit">Update User</button>
		                    </div>
		                  </form>
		                </div>
		              </div>
		            </div>
		          </div>
          
</x-app-layout>