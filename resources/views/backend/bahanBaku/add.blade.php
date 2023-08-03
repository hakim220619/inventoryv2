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
                    <form action="/BahanBaku/addProses" method="POST" class="custom-validation" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="kode">Kode</label>
                                    <input type="text" class="form-control" id="kode" name="kode"
                                         placeholder="Masukan Kode" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="jenis_bale">Jenis
                                        Bale</label>
                                    <input type="text" class="form-control" id="jenis_bale" name="jenis_bale"
                                         placeholder="Masukan Jenis Bale" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="brand">Brand</label>
                                    <input type="text" class="form-control" id="brand" name="brand"
                                         placeholder="Masukan Brand" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="stock">Stock</label>
                                    <input type="number" class="form-control" id="stock" name="stock"
                                         placeholder="Masukan Stock" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="/BahanBaku" type="button" class="btn btn-success">Kembali</a>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
