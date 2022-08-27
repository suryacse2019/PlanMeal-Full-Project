<x-guest-layout>
    <div class="row">
        <div class="col-12">
            <div class="login-card">
                
        <form method="POST"  class="theme-form login-form" action="{{ route('password.email') }}">
            @csrf
                    <h4>Forgot Password</h4>
                    <div class="form-group">
                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                        <label>Email Address</label>
                        <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                            <input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <input id="checkbox1" type="checkbox">
                            <label for="checkbox1">Remember password</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Forgot</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
