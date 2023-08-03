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
                    <div class="row">
                        <div class="col-md-2">
                            <label class="form-label" for="gudang">Gudang</label>
                            <select class="form-control" name="gudang" id="gudang" onchange="laporan()">
                                <option value="" selected>-- Pilih --</option>
                                <option value="spinning 1">Spinning 1</option>
                                <option value="spinning 2">Spinning 2</option>
                                <option value="spinning 3">Spinning 3</option>
                                <option value="spinning 3A">Spinning 3A</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <button class="btn btn-success" onclick="export_listing()" style="margin-top: 7px;">Cetak</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="datatablessssss" class="table table-striped table-bordered dt-responsive nowrap"
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
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <script>
        laporan();
        // $('#datatable').dataTable();
        // DataTable('#datatable');
        function laporan() {
            $.ajax({
                type: 'GET',
                url: "{{ route('laporan.load_data') }}",
                data: {
                    gudang: $("#gudang").val(),
                },
                async: true,
                dataType: 'json',
                beforeSend: function() {
                    $('.progress-bar').attr('style', "width: 0%");
                },
                success: function(data) {
                    var html = '';
                    var i;
                    var no = 1;
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
                    // $('#datatab').dataTable();
                    $(document).ready(function() {
                        $('#datatablessssss').DataTable();
                    });
                    $('#show_data').html(html);
                    $('.progress-bar').attr('style', "width: 100%");

                }
            });
        }

        function export_listing() {
            $.get("{{ route('laporan.process') }}", {
                _token: '{{ csrf_token() }}',
                gudang: $(`#gudang`).val(),
            }, function(res) {

                if (res.success == false) {
                   
                } else {
                    console.log(res);
                    var $a = $("<a>");
                    $a.attr("href", res.file);
                    $("body").append($a);
                    $a.attr("download", res.file_name);
                    $a[0].click();
                    $a.remove();
                    $.messager.progress('close');
                }

            });
        }


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
                            url: '{{ url('product/delete/') }}/' + id,
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
