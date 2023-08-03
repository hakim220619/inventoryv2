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
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="/product" class="btn btn-success waves-effect waves-light"><i
                            class="mdi mdi-keyboard-return"></i> Kembali</a>
                    <button type="button" class="btn btn-dark waves-effect waves-light " data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">Product</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light " id="sendData">Simpan</button>
                    <br>
                    <br>
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="datatab" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Jenis Bale</th>
                                        <th>No Bale</th>
                                        <th>Gross</th>
                                        <th>Berat/KG</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="cart">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    <!-- end col -->
    </div>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Product
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="datatabless"
                                class="table table-striped table-bordered dt-responsive nowrap productList"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Jenis Bale</th>
                                        <th>Brand</th>
                                        <th>Stock</th>
                                        <th>Gross</th>
                                        <th>Berat/KG</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="show_data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    <!-- end row -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            data_jenisBale();
            cart();
            // $('#data_order').dataTable();

            function data_jenisBale() {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('product.load_data') }}",
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
                                '<td>' + data[i].kode + '</td>' +
                                '<td>' + data[i].jenis_bale + '</td>' +
                                '<td>' + data[i].brand + '</td>' +
                                '<td>' + data[i].stock + '</td>' +
                                '<td>' +
                                '<input type="number" class="gross" name="gross" id="gross" value="1" min="1" style="width: 70%; border-color: #e3e3e3; border-radius: 10px;">' +
                                '</td>' +
                                '<td>' +
                                '<input type="number" class="berat" name="berat" id="berat" value="1" min="1" style="width: 70%; border-color: #e3e3e3; border-radius: 10px;">' +
                                '</td>' +
                                '<td nowrap="nowrap">' + button + '</td>' +
                                '</tr>';
                        }
                        $(document).ready(function() {
                            $('#datatabless').DataTable();
                        });
                        $('#show_data').html(html);
                        cart();
                    }
                });
            }

            function cart() {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('product.listProduct') }}',
                    async: true,
                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                        var i;
                        var no = 1;
                        var button =
                            '<button type="submit" class="btn btn-danger delete" id="simpan" value="save">Delete</button>';
                        for (i = 0; i < data.length; i++) {
                            html += '<tr>' +
                                '<td>' + no++ + '</td>' +
                                '<td>' + data[i].kode + '</td>' +
                                '<td>' + data[i].jenis_bale + '</td>' +
                                '<td>' + data[i].no_bale + '</td>' +
                                '<td>' + data[i].gross + '</td>' +
                                '<td>' + data[i].berat + '</td>' +
                                '<td nowrap="nowrap"> ' + button + '</td>' +
                                '</tr>';
                        }
                        $(document).ready(function() {
                            $('#datatab').DataTable();
                        });
                        $('#cart').html(html);
                    }
                });
            }
            $(".productList").on('click', '.btnSelect', function() {

                var currentRow = $(this).closest("tr");
                var kode = currentRow.find("td:eq(1)").text();
                var jenis_bale = currentRow.find("td:eq(2)").text();
                var brand = currentRow.find("td:eq(3)").text();
                var stock = currentRow.find("td:eq(4)").text();
                var gross = currentRow.find("input.gross").val();
                var berat = currentRow.find("input.berat").val();
                // console.log(stock);
                $.ajax({
                    type: "GET",
                    url: '{{ route('product.add_orders') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        kode: kode,
                        jenis_bale: jenis_bale,
                        brand: brand,
                        stock: stock,
                        gross: gross,
                        berat: berat,

                    },
                    beforeSend: function() {
                        $('.progress-bar').attr('style', "width: 0%");
                    },
                    success: function(data) {
                        data_jenisBale();
                        $('.progress-bar').attr('style', "width: 100%");
                    },
                    cache: false,
                    dataType: 'html',
                }).done(function(data) {
                    // alert("success");
                    console.log(data);
                }).fail(function(jqxhr, textStatus, error) {
                    var err = textStatus + ", " + error;
                    console.log("Request Failed: " + err);
                });
                return false;


            });


            $('#sendData').click(function() {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('product.sendDataProduct') }}',
                    async: true,
                    dataType: 'json',
                    beforeSend: function() {
                        $('.progress-bar').attr('style', "width: 0%");
                    },
                    success: function(data) {
                        data_jenisBale();
                        $('.progress-bar').attr('style', "width: 100%");
                    },
                });
            });
        })

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
                            url: '{{ url('BahanBaku/delete/') }}/' + id,
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
