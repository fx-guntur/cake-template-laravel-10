<style>
    body {
      margin-top: 5rem;
    }

    .form-control:focus {
      box-shadow: none;
      border-color: #BA68C8;
    }

    .profile-button {
      background: rgb(99, 39, 120);
      box-shadow: none;
      border: none;
    }

    .profile-button:hover {
      background: #682773;
    }

    .profile-button:focus {
      background: #682773;
      box-shadow: none;
    }

    .profile-button:active {
      background: #682773;
      box-shadow: none;
    }

    .back:hover {
      color: #682773;
      cursor: pointer;
    }

    .labels {
      font-size: 11px;
    }

    .add-experience:hover {
      background: #BA68C8;
      color: #fff;
      cursor: pointer;
      border: solid 1px #BA68C8;
    }
  </style>

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
      <!-- Profile Settings -->
      <div class="col-md-6 border-right">
        <div class="p-3 py-5">
          <h4 class="text-right">Profile Settings</h4>
          <div class="row mt-2">
            <div class="col-md-6"><label class="labels">Name</label><input type="text" class="form-control" placeholder="first name" value=""></div>
            <div class="col-md-6"><label class="labels">Surname</label><input type="text" class="form-control" value="" placeholder="surname"></div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control" placeholder="enter phone number" value=""></div>
            <div class="col-md-12"><label class="labels">Email ID</label><input type="text" class="form-control" placeholder="enter email id" value=""></div>
            <div class="col-md-12"><label class="labels">Password</label><input type="text" class="form-control" placeholder="password" value=""></div>
          </div>
          <div class="mt-5 text-center">
            <button class="btn btn-primary profile-button" type="button">Save Profile</button>
          </div>
        </div>
      </div>      <!-- Recent Transactions -->
      <div class="col-md-6">
        <div class="p-3 py-5">
          <h4 class="mb-4">Recent Transactions</h4>

          <!-- Daftar transaksi -->
          <div class="list-group">
            <!-- Transaksi 1 -->
            <div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-2">
              <span>Product 1</span>
              <span>23 Sep 2024</span> <!-- Ganti tombol dengan tanggal -->
            </div>
            <!-- Transaksi 2 -->
            <div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-2">
              <span>Product 2</span>
              <span>18 Sep 2024</span> <!-- Ganti tombol dengan tanggal -->
            </div>
            <!-- Transaksi 3 -->
            <div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-2">
              <span>Product 3</span>
              <span>12 Sep 2024</span> <!-- Ganti tombol dengan tanggal -->
            </div>
            <!-- Transaksi 4 -->
            <div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-2">
              <span>Product 4</span>
              <span>05 Sep 2024</span> <!-- Ganti tombol dengan tanggal -->
            </div>
            <!-- Transaksi 5 -->
            <div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-2">
              <span>Product 5</span>
              <span>01 Sep 2024</span> <!-- Ganti tombol dengan tanggal -->
            </div>
          </div>

          <!-- Tombol Show More -->
          <div class="d-flex justify-content-center mt-4">
            <a href="#showmore" class="btn btn-primary">Show More</a>
          </div>
        </div>
      </div>
    </div>
  </div>
