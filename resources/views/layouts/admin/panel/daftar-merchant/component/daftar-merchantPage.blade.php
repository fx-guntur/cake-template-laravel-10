<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row container d-flex justify-content-center align-items-center">
                    <div class=" d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7 ">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" action="{{ route('admin.add-merchant') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="username"
                                        id="exampleUsername" placeholder="Username" required>
                                    @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email"
                                        id="exampleInputEmail" placeholder="Email Address" required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" name="password"
                                            id="exampleInputPassword" placeholder="Password" required>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="password-confirmation" name="password_confirmation"
                                            placeholder="Repeat your password" required>
                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>
                            <div class="text-center">
                                <a class="small" href="merchant.login">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->any())
                alert('Errors:\n{{ implode("\n", $errors->all()) }}');
            @endif

            @if (session('success'))
                alert('{{ session('success') }}');
            @endif
        });
    </script>
</body>
