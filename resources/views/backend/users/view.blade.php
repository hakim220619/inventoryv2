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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="addUsers" type="button" class="btn btn-dark waves-effect waves-light ">Add</a>
                    <br>
                    <br>
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Telephone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($users as $a)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td width="auto">
                                                @if ($a->image != null)
                                                    <img src="{{ asset('') }}storage/images/users/{{ $a->image }}"
                                                         class="avatar-xs me-2 rounded-circle"
                                                        alt="Gambar Kosong">
                                                @else
                                                    <img src="{{ asset('') }}storage/images/users/user.png"
                                                         class="avatar-xs me-2 rounded-circle"
                                                        alt="Null">
                                                @endif
                                            </td>
                                            <td width="auto">{{ $a->full_name }}</td>
                                            <td width="auto">{{ $a->email }}</td>
                                            <td width="auto">{{ $a->phone }}</td>
                                            <td width="auto">{{ $a->status }}</td>
                                            
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4">

                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#EditUsers{{ $a->id }}"><i
                                                                class="far fa-edit" style="color: black"></i></a>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#ChangePassword{{ $a->id }}"><i
                                                                class="fas fa-key" style="color: rgb(10, 66, 221)"></i></a>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <a href="#" onclick="deleteItem(this)"
                                                            data-id="{{ $a->id }}"><i
                                                                class="fas
                                                            fa-trash-alt"
                                                                style="color:red"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div id="ChangePassword{{ $a->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0" id="myModalLabel">Change Password
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="users/changePassword" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf

                                                            <input type="text" name="id"
                                                                value="{{ $a->id }}" hidden>
                                                            <div class="row">
                                                                <input type="text" name="id"
                                                                    value="{{ $a->id }}" hidden>
                                                                <div class="col-md-12">
                                                                    <div class="mb-3 password-input-container">
                                                                        <label class="col-md-2 col-form-label"
                                                                            for="password">Password</label>
                                                                        <input type="password"
                                                                            class="form-control password-input"
                                                                            id="txtPasswordLogin" name="password"
                                                                            placeholder="Masukan Password" required />
                                                                        <i class="toggle-password fa fa-eye"></i>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light waves-effect"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary waves-effect waves-light">Save</button>
                                                            </div>
                                                        </form>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                        </div>
                                        <div class="modal fade" id="EditUsers{{ $a->id }}" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" role="dialog"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Admin
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="/users/editProses" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">

                                                            <input type="text" name="id"
                                                                value="{{ $a->id }}" hidden>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="full_name">Nama
                                                                            Lengkap</label>
                                                                        <input type="text" class="form-control"
                                                                            id="full_name" name="full_name"
                                                                            value="{{ $a->full_name }}"
                                                                            placeholder="Masukan Nama Lengkap" required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label"
                                                                            for="email">Email</label>
                                                                        <input type="email" class="form-control"
                                                                            id="email" name="email"
                                                                            value="{{ $a->email }}"
                                                                            placeholder="Masukan Email" required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="phone">Nomor
                                                                            Telepon</label>
                                                                        <input type="text" class="form-control"
                                                                            id="phone" name="phone"
                                                                            value="{{ $a->phone }}"
                                                                            placeholder="Masukan Nomor Telepon" required />
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label"
                                                                            for="status">Status</label>
                                                                        <select class="form-control" name="status"
                                                                            id="sts" required>
                                                                            <option value="">-- Pilih --</option>
                                                                            @foreach ($status as $r)
                                                                                <option value="{{ $r }}"
                                                                                    {{ $r == $a->status ? 'selected' : '' }}>
                                                                                    {{ $r }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label"
                                                                            for="image">Image</label>
                                                                        <input type="file" class="form-control"
                                                                            id="image" name="image"
                                                                            value="{{ $a->image }}"
                                                                            placeholder="Masukan Gambar" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label"
                                                                            for="address">Alamat</label>
                                                                        <input type="text" class="form-control"
                                                                            id="address" name="address"
                                                                            value="{{ $a->address }}"
                                                                            placeholder="Masukan Alamat" required />
                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light waves-effect"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary waves-effect waves-light">Save</button>
                                                            </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
    <!-- end row -->
    <script>
        function deleteItem(e) {

            let id = e.getAttribute('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    setInterval(function() {
                            location.reload();
                        }, 30000),
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        ),
                        $.ajax({
                            type: 'GET',
                            url: '{{ url('/admin/delete/') }}/' + id,
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(data) {

                                if (data.success) {

                                    swalWithBootstrapButtons.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        "success",

                                    );

                                }

                            }
                        });



                }
                if (result.isConfirmed) location.reload()
            })

        }
    </script>
@endsection
