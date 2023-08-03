@extends('backend.layout.base')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4>{{ $title }}</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ Helper::apk()->app_name }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $title }}</a></li>
                    {{-- <li class="breadcrumb-item active">Dashboard</li> --}}
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
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">


                <form action="/aplikasi/editProses" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="id" id="" value="{{ $aplikasi->id }}" hidden>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3 position-relative">
                                <label class="form-label" for="owner">Owner</label>
                                <input type="text" class="form-control" id="owner" name="owner"
                                    value="{{ $aplikasi->owner }}" placeholder="Owner" required>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3 position-relative">
                                <label class="form-label" for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Address" value="{{ $aplikasi->address }}" required>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3 position-relative">
                                <label class="form-label" for="telephone">Telephone</label>
                                <input type="text" class="form-control" id="telephone" name="telephone"
                                    placeholder="Telephone" value="{{ $aplikasi->telephone }}" required>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3 position-relative">
                                <label class="form-label" for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                                    value="{{ $aplikasi->title }}" required>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3 position-relative">
                                <label class="form-label" for="app_name">App Name</label>
                                <input type="text" class="form-control" id="app_name" name="app_name"
                                    placeholder="App Name" value="{{ $aplikasi->app_name }}" required>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3 position-relative">
                                <label class="form-label" for="copy_right">Copy Right</label>
                                <input type="text" class="form-control" id="copy_right" name="copy_right"
                                    placeholder="Copy Right" value="{{ $aplikasi->copy_right }}" required>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3 position-relative">
                                <label class="form-label" for="version">Version</label>
                                <input type="text" class="form-control" id="version" name="version"
                                    placeholder="Version" value="{{ $aplikasi->version }}" required>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3 position-relative">
                                <label class="form-label" for="image">Logo</label>
                                <input type="file" class="form-control" id="image" name="image"
                                    placeholder="Last name">
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- end row -->
                    <button class="btn btn-primary" type="submit">Save</button>
                </form>
            </div>
        </div>
        <!-- end card -->
    </div> <!-- end col -->
    </div>

@endsection
