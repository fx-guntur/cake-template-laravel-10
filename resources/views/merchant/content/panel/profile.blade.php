

<div class="container mt-1">
    <h3 class="mb-4">Profile: Edit Data</h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li
          class="breadcrumb-item active"
          aria-current="page"
        >
          Edit Profile
        </li>
      </ol>
    </nav>

    <div class="card">
      <div class="card-header">
        <strong>Jabatan: PROFILE</strong>
      </div>
      <div class="card-body">
        <!-- Row for the buttons -->
        <div class="d-flex justify-content-between mb-2">
          <button
            type="button"
            class="btn btn-secondary"
          >
            <i class="fas fa-arrow-left"></i> Kembali
          </button>
          <button
            type="button"
            class="btn btn-warning"
          >
            <i class="fas fa-key"></i> Update Password
          </button>
        </div>

        <form>
          <div class="form-group">
            <label for="name">Nama <span class="text-danger">*</span></label>
            <input
              type="text"
              class="form-control"
              id="name"
              value="Admin"
              required
            />
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input
              type="email"
              class="form-control"
              id="email"
              value="admin@attendance.test"
              readonly
            />
          </div>
        </form>
      </div>
    </div>

    <footer class="text-beetwen mt-5">
      <small>PT. Hasanah Jariyah Aplikanusa</small>
    </footer>
  </div>
<!-- End of Main Content -->
