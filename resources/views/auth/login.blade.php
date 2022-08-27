<x-guest-layout>
    <div class="row">
        <div class="col-12">
            <div class="login-card">
                <form class="theme-form login-form" action="{{ route('login') }}" method="POST">
                    @csrf
                    <h4>Login</h4>
                    <h6>Welcome back! Log in to your account.</h6>
                    <div class="form-group">
                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                        <label>Email Address</label>
                        <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                            <input class="form-control" type="email" name="email" required=""  placeholder="Test@gmail.com">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                            <input class="form-control" type="password" name="password" required="" placeholder="*********">
                            <div class="show-hide"><span class="show"></span></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <input id="checkbox1" type="checkbox">
                            <label for="checkbox1">Remember password</label>
                        </div><a class="link" href="forgot-password">Forgot password?</a>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
