<x-app-layout>
              
                  <form class="card" action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="card-header pb-0">
                      <h4 class="card-title mb-0">User Profile</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label"> Name</label>
                            <input class="form-control" id="name" name="name" type="text" placeholder="Name">
                          </div>
                        </div>

                        
                        <div class="col-sm-5 col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input class="form-control"  id="email" name="email"  type="email" placeholder="Email">
                          </div>
                        </div>
                        
                          <div class="col-sm-5 col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input class="form-control" di="password" name="password" type="password" placeholder="Password">
                          </div>
                        </div>

                         
                          <div class="col-md-5 col-md-4">
                                 <div class="mb-3">
                                    <label class="form-label">Role</label>  
                                    @if(!empty($role))
                                <select class="form-select" id="role" name="role" required="">
                                  <option>Role</option>
                                  @foreach($role as $rolelist)
                                  <option value="{{$rolelist->id}}">{{$rolelist->role_name}}</option>
                                  @endforeach
                                </select>
                                @endif
                            </div>
                          </div>
                              <div class="col-md-5 mb-4">
                              	 <div class="mb-3">
                              	    <label class="form-label">status</label>	
                                <select class="form-select" id="status" name="status" placeholder="status" required="">
                                  <option>status</option>
                                   <option value= "1">Active</option>
                                   <option value= "0">Inactive</option>

                                </select>
                            </div>
    
		                        </div>
		                      </div>
		                    </div>
		                    <div class="card-footer text-end">
		                      <button class="btn btn-primary" type="submit">Add User</button>
		                    </div>
		                  </form>
		                </div>
		              </div>
		            </div>
		          </div>
          
</x-app-layout>