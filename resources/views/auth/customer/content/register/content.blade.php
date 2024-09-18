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
              <h1>Sign Up</h1>
              <p>Persiapkan diri untuk masa depan yang penuh dengan bintang</p>
          </div>
          <form action="{{ route('customer.register') }}" method="post" id="signup-form">
              @csrf
              <div class="input-group border-primary">
                  <label for="name">Name</label>
                  <input type="text" class="placeholder-primary" id="name" name="name" placeholder="Your name" required>
                  @error('name')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
              <div class="input-group border-primary">
                  <label for="email">Email</label>
                  <input type="email" class="placeholder-primary" id="email" name="email" placeholder="Your email" required>
                  @error('email')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
              <div class="input-group border-primary">
                  <label for="username">Username</label>
                  <input type="text" class="placeholder-primary" id="username" name="username" placeholder="Your username" required>
                  @error('username')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
              <div class="input-group border-primary">
                  <label for="phone">Phone</label>
                  <input type="text" class="placeholder-primary" id="phone" name="phone" placeholder="Your phone number" required>
                  @error('phone')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
              <div class="input-group border-primary">
                  <label for="password">Password</label>
                  <input type="password" class="placeholder-primary" id="password" name="password" placeholder="Your password" required>
                  @error('password')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
              <div class="input-group border-primary">
                  <label for="password-confirmation">Password Confirmation</label>
                  <input type="password" class="placeholder-primary" id="password-confirmation" name="password_confirmation" placeholder="Your password confirmation" required>
                  @error('password_confirmation')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
              <button type="submit" class="btn-secondary btn-submit">Sign Up</button>
              <p class="text-center">Already have an account? <a href="{{ route('customer.login') }}" class="link">Sign In</a></p>
          </form>
      </section>
  </main>

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