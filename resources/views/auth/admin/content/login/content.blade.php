<body>
    <main>
        <section id="auth-hero">
            <img src="{{ asset('img/sign-up-image.png') }}" alt="Image Sign Up" class="background">
            <div class="content">
                <h2 class="title">Selangkah Lebih Dekat Dengan Impianmu</h2>
                <p class="description">Sebuah layanan E-Learning gratis yang siap membantumu menjadi seorang ahli</p>
            </div>
        </section>
        <section id="auth-form">
            <a class="btn-back" href="/">
                <i class="fa-solid fa-arrow-left"></i>
                <p>Homepage</p>
            </a>
            <div class="header">
                <h1>Sign In</h1>
                <p>Persiapkan diri untuk masa depan yang penuh dengan bintang</p>
            </div>
            <form action="{{ route('admin.login.store') }}" method="POST">
                @csrf
                <div class="input-group border-primary">
                    <label for="identifier">Username </label>
                    <input type="text" class="placeholder-primary" id="username" name="identifier"
                        placeholder="Your Username" required>
                </div>

                <!-- Input Password dengan Icon Mata -->
                <div class="input-group border-primary">
                    <label for="password">Password</label>
                    <div class="input-password-wrapper">
                        <input type="password" class="placeholder-primary" id="password" name="password"
                            placeholder="Your password" required>
                        <span class="toggle-password" id="eyeIcon">
                            👁<!-- Ikon mata untuk toggle password -->
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn-secondary btn-submit">Sign In</button>
                <p class="text-center">Don't have an account? <a href="signup" class="link">Sign Up</a></p>
            </form>
        </section>
    </main>

    @if (session('success'))
        <script>
            window.onload = function() {
                swal("Success", "Test Success Message", "success");
            };
        </script>
    @endif

    @if (session('error'))
        <script>
            window.onload = function() {
                swal("Error", "Test Error Message", "error");
            };
        </script>
    @endif

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

    <!-- Script untuk Toggle Show Password -->
    <script>
        const eyeIcon = document.getElementById('eyeIcon');
        const passwordInput = document.getElementById('password');

        eyeIcon.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.textContent = type === 'text' ? '🙈' : '👁';
        });
    </script>

    <!-- CSS untuk ikon dan tata letak password -->
    <style>
        .input-password-wrapper {
            position: relative;
            width: 100%;
        }

        .input-password-wrapper input {
            width: 100%;
            padding-right: 40px; /* Memberi ruang untuk ikon di sebelah kanan */
        }

        .toggle-password {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</body>
