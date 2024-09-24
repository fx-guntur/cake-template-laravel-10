<style>
    body {
        margin-top: 5rem;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #BA68C8;
    }

    .profile-button {
        background: hsl(81, 92%, 40%);
        box-shadow: none;
        border: none;
    }

    .profile-button:hover {
        background: #82c408ff;
    }

    .profile-button:focus {
        background: #82c408ff;
        box-shadow: none;
    }

    .profile-button:active {
        background: #82c408ff;
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


<div class="container rounded bg-white mt-1 mt-sm-5 mb-5"> <!-- mt-3 untuk mobile, mt-sm-5 untuk desktop -->
    <div class="row">
        <!-- Profile Settings -->
        <div class="col-md-6 border-right">
            <div class="p-3 py-2 py-sm-5">
                <div class="row">
                    <div class="col-12">
                        <label class="labels">Name:</label>
                        <input type="text" class="form-control" placeholder="first name" value="{{ $user->name }}"
                            readonly>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label class="labels">Phone Number:</label>
                        <input type="text" class="form-control" placeholder="enter phone number"
                            value="{{ $user->phone }}" readonly>
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Email:</label>
                        <input type="text" class="form-control" placeholder="enter email id"
                            value="{{ $user->email }}" readonly>
                    </div>
                    {{-- Uncomment this if you want to display password but keep it read-only --}}
                    {{-- <div class="col-md-12">
              <label class="labels">Password</label>
              <input type="text" class="form-control" placeholder="password" value="" readonly>
          </div> --}}
                </div>
                <div class="row mt-3">
                    <div class="d-flex justify-content-center justify-content-md-end mt-3">
                        <div class="me-2">
                            <button class="btn btn-secondary text-white" type="button">Edit Profile</button>
                        </div>
                        <div class="me-2">
                            <button class="btn btn-primary text-white" type="button">Save Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- Recent Transactions -->
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
                <div class="d-flex justify-content-center justify-content-md-end mt-4">
                    <a href="#showmore" class="btn btn-primary text-white">Show More</a>
                </div>
            </div>
        </div>
    </div>
</div>
