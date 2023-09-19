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
                    <form action="/wishlist/addProses" method="POST" class="custom-validation" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <input type="number" class="form-control" id="jumlah" name="jumlah"
                                        value="{{ old('jumlah') }}" placeholder="Masukan Jumlah" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="jenis" id="jenis">
                                    <option value="" selected>-- Jenis Bale --</option>
                                    @foreach ($jenis_bale as $jb)
                                        <option value="{{ $jb->jenis_bale }}">{{ $jb->jenis_bale }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                {{-- <a href="/admin" type="button" class="btn btn-success">Kembali</a> --}}
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Jenis</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($wishlist as $a)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td width="auto">{{ $a->full_name }}</td>
                                            <td width="auto">{{ $a->jenis }}</td>
                                            <td width="auto">{{ $a->jumlah }}</td>
                                            <td width="auto">{{ $a->status }}</td>
                                            <td width="auto">{{ $a->created_at }}</td>
                                            <td><div class="col-md-4">
                                                <a href="#" onclick="deleteItem(this)"
                                                    data-id="{{ $a->id }}"><i
                                                        class="fas
                                                    fa-trash-alt"
                                                        style="color:red"></i></a>
                                            </div></td>
                                        </tr>
                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    </div>
@endsection
