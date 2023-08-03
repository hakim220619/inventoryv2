@extends('backend.layout.base')

@section('content')


    <div class="row">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4>{{ $title }}</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ Helper::apk()->app_name }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript: void(0);">{{ $title }}</a></li>

                </ol>
            </div>
        </div>
        {{-- <div class="col-sm-6">
            <div class="state-information d-none d-sm-block">
                <div class="state-graph">
                    <div id="header-chart-1"></div>
                    <div class="info">Balance $ 2,317</div>
                </div>
                <div class="state-graph">
                    <div id="header-chart-2"></div>
                    <div class="info">Item Sold 1230</div>
                </div>
            </div>
        </div> --}}
    </div>

    <!-- end page title -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="/users/addProses" method="POST" class="custom-validation" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="col-md-2 col-form-label" for="full_name">Nama
                                        Lengkap</label>
                                    <input type="text" class="form-control" id="full_name" name="full_name"
                                        value="{{ old('full_name') }}" placeholder="Masukan Nama Lengkap" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="col-md-2 col-form-label" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" placeholder="Masukan Email" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 password-input-container">
                                    <label class="col-md-2 col-form-label" for="password">Password</label>
                                    <input type="password" class="form-control password-input" id="txtPasswordLogin" name="password"
                                        placeholder="Masukan Password" required />
                                        <i class="toggle-password fa fa-eye"></i>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 ">
                                    <label class="col-md-2 col-form-label" for="tlp">Nomor
                                        Telepon</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ old('phone') }}" placeholder="Masukan Nomor Telepon" required />
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="col-md-2 col-form-label" for="role">Role</label>
                                    <select class="form-control" name="role" id="role" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="1">Admin</option>
                                        <option value="3">Super Admin</option>

                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="col-md-2 col-form-label" for="status">Status</label>
                                    <select class="form-control" name="status" id="sts" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="ON">ON</option>
                                        <option value="OF">OFF</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="col-md-2 col-form-label" for="image">Image</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        placeholder="Masukan Gambar" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="col-md-2 col-form-label" for="address">Alamat</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="{{ old('address') }}" placeholder="Masukan Address" required />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <br>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="/admin" type="button" class="btn btn-success">Kembali</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
