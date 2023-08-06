@extends('backend.layout.base')

@section('content')
    <style>
        .fontSize {
            font-size: 80%;
        }
    </style>
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
        <div class="col-xl-3 col-sm-6">
            <div class="card mini-stat bg-primary">
                <div class="card-body mini-stat-img">
                    <div class="mini-stat-icon">
                        <i class="mdi mdi-account-cog-outline float-end"></i>
                    </div>
                    <div class="text-white">
                        <h6 class="text-uppercase mb-3 font-size-16 text-white">Admin</h6>
                        <h2 class="mb-4 text-white">{{ $admin }}</h2>
                        <span class="badge bg-info"> {{ substr($percantageAdmin[0]->progres, 0, 4) }}% </span> <span
                            class="ms-2 fontSize">Admin register this month</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card mini-stat bg-primary">
                <div class="card-body mini-stat-img">
                    <div class="mini-stat-icon">
                        <i class="mdi mdi-account-cowboy-hat float-end"></i>
                    </div>
                    <div class="text-white">
                        <h6 class="text-uppercase mb-3 font-size-16 text-white">Super Admin</h6>
                        <h2 class="mb-4 text-white">{{ $supadmin }}</h2>
                        <span class="badge bg-danger"> {{ substr($percantageUser[0]->progres, 0, 4) }}% </span> <span
                            class="ms-2 fontSize">Super Admin register this month</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card mini-stat bg-primary">
                <div class="card-body mini-stat-img">
                    <div class="mini-stat-icon">
                        <i class="mdi mdi-account-tie float-end"></i>
                    </div>
                    <div class="text-white">
                        <h6 class="text-uppercase mb-3 font-size-16 text-white">Users</h6>
                        <h2 class="mb-4 text-white">{{ $users }}</h2>
                        <span class="badge bg-warning"> {{ substr($percantageSuAdmin[0]->progres, 0, 4) }}% </span> <span
                            class="ms-2 fontSize">Users register this month</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card mini-stat bg-primary">
                <div class="card-body mini-stat-img">
                    <div class="mini-stat-icon">
                        <i class="mdi mdi-account-group float-end"></i>
                    </div>
                    <div class="text-white">
                        <h6 class="text-uppercase mb-3 font-size-16 text-white">All Users</h6>
                        <h2 class="mb-4 text-white">{{ $allusers }}</h2>
                        <span class="badge bg-info"> {{ substr($percantageAllUser[0]->progres, 0, 4) }}% </span> <span
                            class="ms-2 fontSize">All Users register this month</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    @if (request()->user()->role == 2)
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Latest Transactions</h4>

                        <div class="table-responsive">
                            <table class="table align-middle table-centered table-vertical table-nowrap">

                                <tbody id="show_delivered">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Latest Orders</h4>

                        <div class="table-responsive">
                            <table class="table align-middle table-centered table-vertical table-nowrap mb-1">

                                <tbody>
                                    @foreach ($approvedOrders as $ao)
                                        <tr>
                                            <td>{{ $ao->no_transaksi }}</td>

                                            <td>
                                                @if ($ao->status == 'APPROVAL')
                                                    <span class="badge rounded-pill bg-warning">APPROVAL</span>
                                                @else
                                                    <span class="badge rounded-pill bg-success">DELIVERED</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $ao->tujuan }}
                                            </td>
                                            <td>
                                                {{ $ao->total }}
                                            </td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-secondary btn-sm waves-effect waves-light"
                                                    data-bs-toggle="modal" data-bs-target="#proses"
                                                    value="{{ $ao->no_transaksi }}"
                                                    onclick="transaksi(this.value)">Proses</button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="proses" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Detail Product
                        </h5>
                        <input type="hidden" name="" id="no_transaksi">
                        <button class="btn btn-success" style="margin-left: 20px;"
                            onclick="sendDelivered()">Delivered</button>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">


                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table id="data"
                                            class="table table-striped table-bordered dt-responsive nowrap"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No Transaksi</th>
                                                    <th>Kode</th>
                                                    <th>Jenis Bale</th>
                                                    <th>No Bale</th>
                                                    <th>Gross</th>
                                                    <th>Berat/KG</th>
                                                    <th>Status</th>
                                                    <th>Tujuan</th>
                                                    <th>Created</th>

                                                </tr>
                                            </thead>

                                            <tbody id="show_data">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- end col -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
    @endif
    <script>
        transaksi();
        Delivered();
        // DataTable('#da');
        function transaksi(param) {
            $.ajax({
                type: 'GET',
                url: "{{ route('dashboard.load_data') }}",
                data: {
                    no_transaksi: param
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    var no = 1;
                    var button =
                        '<button type="submit" class="btn btn-primary btnSelect" id="simpan" value="save">Pilih</button>';
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            '<td>' + no++ + '</td>' +
                            '<td>' + data[i].no_transaksi + '</td>' +
                            '<td>' + data[i].kode + '</td>' +
                            '<td>' + data[i].jenis_bale + '</td>' +
                            '<td>' + data[i].no_bale + '</td>' +
                            '<td>' + data[i].gross + '</td>' +
                            '<td>' + data[i].berat + '</td>' +
                            '<td>' + data[i].status + '</td>' +
                            '<td>' + data[i].tujuan + '</td>' +
                            '<td>' + data[i].created_at + '</td>' +

                            '</tr>';
                    }
                    $("#no_transaksi").val(data[0].no_transaksi);
                    $('#show_data').html(html);
                }
            });
        }

        function Delivered(param) {
            $.ajax({
                type: 'GET',
                url: "{{ route('dashboard.load_delivered') }}",
                data: {
                    no_transaksi: param
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    var no = 1;
                    var button =
                        '<button type="submit" class="btn btn-primary btnSelect" id="simpan" value="save">Pilih</button>';
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            '<td>' + no++ + '</td>' +
                            '<td>' + data[i].no_transaksi + '</td>' +
                            '<td>' + '<span class="badge rounded-pill bg-success">' + data[i].status +
                            '</span>' + '</td>' +
                            '<td>' + data[i].tujuan + '</td>' +
                            '<td>' + data[i].total + '</td>' +

                            '</tr>';
                    }

                    transaksi();
                    Delivered();
                    $('#show_delivered').html(html);
                }
            });
        }

        function sendDelivered() {
            $.ajax({
                type: "GET",
                url: '{{ route('dashboard.sendDelivered') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    no_transaksi: $("#no_transaksi").val(),
                },
                beforeSend: function() {
                    $('.progress-bar').attr('style', "width: 0%");
                },
                success: function(data) {
                    transaksi();
                    Delivered();
                    location.reload();
                    $('.progress-bar').attr('style', "width: 100%");
                },
                cache: false,
                dataType: 'html',
            });
            return false;
        }
    </script>
@endsection
