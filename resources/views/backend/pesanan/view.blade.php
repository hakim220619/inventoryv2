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
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-dark waves-effect waves-light " data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">Product</button>

                    <button class="btn btn-success batalall" style="margin-left: 20px;">Batal</button>

                    <br>
                    <br>
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="datat"
                                class="table table-striped table-bordered dt-responsive nowrap cartToProduct"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="allbtl" name="allbtl" /></th>
                                        <th>No</th>
                                        <th>Jenis Bale</th>
                                        <th>No Bale</th>
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
        <div class="col-md-4">
            <div class="card">
                <div class="card-body" id="send">
                    <h3>Transaksi</h3>

                    <div class="mb-3">
                        <label class="form-label" for="no_transaksi">No Transaksi</label>
                        <input type="text" class="form-control" id="no_transaksi" name="no_transaksi"
                            value="TRX{{ rand(0000, 9999) }}" placeholder="Masukan No Transaksi" required readonly />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="tujuan">Tujuan</label>
                        <select class="form-control" name="tujuan" id="tujuan">
                            <option value="" selected>-- Pilih --</option>
                            <option value="spinning 1">Spinning 1</option>
                            <option value="spinning 2">Spinning 2</option>
                            <option value="spinning 3">Spinning 3</option>
                            <option value="spinning 3A">Spinning 3A</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary waves-effect waves-light sendTransaski">Pesan</button>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Product
                    </h5>
                    <button class="btn btn-success saveall" style="margin-left: 20px;">Save</button>
                    @if ($getCountProduct[0]->total != 0)
                    <a href="/wishlist" class="btn btn-danger" style="margin-left: 20px;">Wishlist</a>
                    @endif
                    
                    <div class="row">
                        <div class="col-md-12" style="margin-left: 20px;">
                            <select class="form-control" name="jenis_bale" id="jenis_bale">
                                <option value="" selected>-- Jenis Bale --</option>
                                @foreach ($jenis_bale as $jb)
                                    <option value="{{ $jb->jenis_bale }}">{{ $jb->jenis_bale }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="number" class="form-control" name="limit" id="limit"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"
                                style="margin-left: 40px;width: 50%;">
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="dat"
                                class="table table-striped table-bordered dt-responsive nowrap productCart"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="allcb" name="allcb" /></th>
                                        <th>No</th>
                                        <th>Jenis Bale</th>
                                        <th>No Bale</th>
                                        <th>Status</th>
                                        <th>Created</th>
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
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            data_jenisBale();
            cart();
            // DataTable('#da');
            function data_jenisBale() {
                // alert("asd")
                $.ajax({
                    type: 'GET',
                    url: "{{ route('pesanan.load_data') }}",
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

                                '<td>' + '<input type="checkbox" value=' + data[i].id +
                                ' name="cb[]" data-id="myId"/>' + '</td>' +
                                '<td>' + no++ + '</td>' +
                                '<td hidden>' + data[i].kode + '</td>' +
                                '<td>' + data[i].jenis_bale + '</td>' +
                                '<td>' + data[i].no_bale + '</td>' +
                                '<td hidden>' + data[i].gross + '</td>' +
                                '<td hidden>' + data[i].berat + '</td>' +
                                '<td>' + data[i].status + '</td>' +
                                '<td>' + data[i].created_at + '</td>' +
                                '<td hidden>' + data[i].id + '</td>' +
                                '</tr>';
                        }

                        $(document).ready(function() {
                            $('#datatablesse').DataTable();
                        });

                        $('#show_data').html(html);
                        cart();
                    }
                });
            }
            $('#allcb').click(function(e) {
                $('[name="cb[]"]').prop('checked', this.checked);
            });

            $('[name="cb[]"]').click(function(e) {
                if ($('[name="cb[]"]:checked').length == $('[name="cb[]"]').length || !this.checked)
                    $('#allcb').prop('checked', this.checked);
            });


            $(".saveall").click(function() {
                var x = "";
                $("[data-id=myId]").each(function() {
                    if (this.checked) {
                        x = x + $(this).val() + ',';
                    }
                });
                // console.log(x.length);
                if (x.length == 0) {
                    alert("Pilih Jenis Bale");
                } else {
                    $.ajax({
                        type: "GET",
                        url: '{{ route('pesanan.addProductAll') }}',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            data: x.split(","),
                            long: x.split(",").length - 1
                        },
                        beforeSend: function() {
                            $('.progress-bar').attr('style', "width: 0%");
                        },
                        success: function(data) {
                            console.log(data);
                            data_jenisBale();
                            cart();
                            $('.progress-bar').attr('style', "width: 100%");
                        },
                        cache: false,
                        dataType: 'json',
                    });
                    return false;
                }
            });

            function cart() {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('pesanan.cart') }}',
                    async: true,
                    dataType: 'json',
                    beforeSend: function() {
                        $('.progress-bar').attr('style', "width: 0%");
                    },
                    success: function(data) {
                        var html = '';
                        var i;
                        var no = 1;
                        var button =
                            '<button type="submit" class="btn btn-warning btnSelectcart" id="simpan" value="save">Batal</button>';
                        for (i = 0; i < data.length; i++) {
                            html += '<tr>' +
                                '<td>' + '<input type="checkbox" value=' + data[i].id +
                                ' name="btl[]" data-id="mybtl"/>' + '</td>' +
                                '<td>' + no++ + '</td>' +
                                '<td hidden>' + data[i].kode + '</td>' +
                                '<td>' + data[i].jenis_bale + '</td>' +
                                '<td>' + data[i].no_bale + '</td>' +
                                '<td hidden>' + data[i].gross + '</td>' +
                                '<td hidden>' + data[i].berat + '</td>' +
                                '<td hidden>' + data[i].id + '</td>' +

                                '</tr>';
                        }
                        $(document).ready(function() {
                            $('#datatablesd').DataTable();
                        });


                        $('#cart').html(html);
                        $('.progress-bar').attr('style', "width: 100%");
                    }
                });
            }
            $('#allbtl').click(function(e) {
                $('[name="btl[]"]').prop('checked', this.checked);
            });

            $('[name="btl[]"]').click(function(e) {
                if ($('[name="btl[]"]:checked').length == $('[name="btl[]"]').length || !this.checked)
                    $('#allbtl').prop('checked', this.checked);
            });
            $('#jenis_bale').change(function(e) {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('pesanan.load_data') }}",
                    data: {
                        jenis_bale: $("#jenis_bale").val()
                    },

                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                        var i;
                        var no = 1;
                        var button =
                            '<button type="submit" class="btn btn-primary btnSelect" id="simpan" value="save">Pilih</button>';
                        for (i = 0; i < data.length; i++) {
                            html += '<tr>' +

                                '<td>' + '<input type="checkbox" value=' + data[i].id +
                                ' name="cb[]" data-id="myId"/>' + '</td>' +
                                '<td>' + no++ + '</td>' +
                                '<td hidden>' + data[i].kode + '</td>' +
                                '<td>' + data[i].jenis_bale + '</td>' +
                                '<td>' + data[i].no_bale + '</td>' +
                                '<td hidden>' + data[i].gross + '</td>' +
                                '<td hidden>' + data[i].berat + '</td>' +
                                '<td>' + data[i].status + '</td>' +
                                '<td>' + data[i].created_at + '</td>' +
                                '<td hidden>' + data[i].id + '</td>' +
                                '</tr>';
                        }

                        $(document).ready(function() {
                            $('#datatablesse').DataTable();
                        });

                        $('#show_data').html(html);
                        cart();
                    }
                });
            });
            $('#limit').keyup(function(e) {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('pesanan.load_data') }}",
                    data: {
                        jenis_bale: $("#jenis_bale").val(),
                        limit: $("#limit").val(),
                    },

                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                        var i;
                        var no = 1;
                        var button =
                            '<button type="submit" class="btn btn-primary btnSelect" id="simpan" value="save">Pilih</button>';
                        for (i = 0; i < data.length; i++) {
                            html += '<tr>' +

                                '<td>' + '<input type="checkbox" value=' + data[i].id +
                                ' name="cb[]" data-id="myId"/>' + '</td>' +
                                '<td>' + no++ + '</td>' +
                                '<td hidden>' + data[i].kode + '</td>' +
                                '<td>' + data[i].jenis_bale + '</td>' +
                                '<td>' + data[i].no_bale + '</td>' +
                                '<td hidden>' + data[i].gross + '</td>' +
                                '<td hidden>' + data[i].berat + '</td>' +
                                '<td>' + data[i].status + '</td>' +
                                '<td>' + data[i].created_at + '</td>' +
                                '<td hidden>' + data[i].id + '</td>' +
                                '</tr>';
                        }

                        $(document).ready(function() {
                            $('#datatablesse').DataTable();
                        });

                        $('#show_data').html(html);
                        cart();
                    }
                });
            });


            $(".batalall").click(function() {
                var x = "";
                $("[data-id=mybtl]").each(function() {
                    if (this.checked) {
                        x = x + $(this).val() + ',';
                    }
                });
                // console.log(x.split(",").length -1);        
                $.ajax({
                    type: "GET",
                    url: '{{ route('pesanan.batalProductAll') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        data: x.split(","),
                        long: x.split(",").length - 1
                    },
                    beforeSend: function() {
                        $('.progress-bar').attr('style', "width: 0%");
                    },
                    success: function(data) {
                        console.log(data);
                        data_jenisBale();
                        cart();
                        $('.progress-bar').attr('style', "width: 100%");
                    },
                    cache: false,
                    dataType: 'json',
                });
                return false;

            });
            $(".productCart").on('click', '.btnSelect', function() {
                var currentRow = $(this).closest("tr");
                var kode = currentRow.find("td:eq(1)").text();
                var jenis_bale = currentRow.find("td:eq(2)").text();
                var no_bale = currentRow.find("td:eq(3)").text();
                var gross = currentRow.find("td:eq(4)").text();
                var berat = currentRow.find("td:eq(5)").text();
                var id = currentRow.find("td:eq(8)").text();
                // console.log(berat);
                $.ajax({
                    type: "GET",
                    url: '{{ route('pesanan.add_orders') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        kode: kode,
                        jenis_bale: jenis_bale,
                        no_bale: no_bale,
                        gross: gross,
                        berat: berat,
                        id: id,
                    },
                    beforeSend: function() {
                        $('.progress-bar').attr('style', "width: 0%");
                    },
                    success: function(data) {
                        data_jenisBale();
                        cart();
                        $('.progress-bar').attr('style', "width: 100%");
                    },
                    cache: false,
                    dataType: 'html',
                });
                return false;
            });
            $(".cartToProduct").on('click', '.btnSelectcart', function() {
                var currentRow = $(this).closest("tr");
                var kode = currentRow.find("td:eq(1)").text();
                var jenis_bale = currentRow.find("td:eq(2)").text();
                var no_bale = currentRow.find("td:eq(3)").text();
                var gross = currentRow.find("td:eq(4)").text();
                var berat = currentRow.find("td:eq(5)").text();
                var id = currentRow.find("td:eq(6)").text();
                // console.log(id);
                $.ajax({
                    type: "GET",
                    url: '{{ route('pesanan.rejected') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        kode: kode,
                        jenis_bale: jenis_bale,
                        no_bale: no_bale,
                        gross: gross,
                        berat: berat,
                        id: id,

                    },
                    beforeSend: function() {
                        $('.progress-bar').attr('style', "width: 0%");
                    },
                    success: function(data) {
                        data_jenisBale();
                        cart();
                        $('.progress-bar').attr('style', "width: 100%");
                    },
                    cache: false,
                    dataType: 'html',
                });
                return false;
            });
            $("#send").on('click', '.sendTransaski', function() {
                $.ajax({
                    type: "GET",
                    url: '{{ route('pesanan.transaksi') }}',
                    async: true,
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        no_transaksi: $('#no_transaksi').val(),
                        tujuan: $('#tujuan').val(),
                    },
                    beforeSend: function() {
                        $('.progress-bar').attr('style', "width: 0%");
                    },
                    success: function(data) {
                        console.log(data);
                        data_jenisBale();
                        cart();
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
