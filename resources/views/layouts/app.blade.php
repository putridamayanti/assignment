<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ASSIGNMENT</title>

    <!-- Styles -->
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/jquery.nice-select.min.js"></script>
    <script type="text/javascript" src="/js/sweetalert.min.js"></script>
    <script>
        function myFunction() {
            $("#myDropdown").slideToggle();
        }
        $(document).ready(function () {

        });

        function addRow() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/addList',
                success: function (data) {
                    console.log('Success Add');
                    console.log(data);
                    var row = ''+
                        '<tr class="row-category'+data.id+'">' +
                        '<td style="vertical-align: middle;">' +
                        '<select class="supplier'+data.id+' form-control" onchange="supplier(this, '+data.id+')">' +
                            @foreach($supplier as $item)
                                '<option value="{{ $item->name }}">{{ $item->name }}</option>'+
                            @endforeach
                                '</select>' +
                        '</td>'+
                        '<td style="vertical-align: middle">' +
                        '<input type="text" name="name" class="form-input nama-produk'+data.id+'" data-toggle="modal" data-target="#myModal">' +
                        '<input type="hidden" id="supplier'+data.id+'">' +
                        '</td>'+
                        '<td style="vertical-align: middle"><input type="text" name="price" class="form-input harga'+data.id+'"></td>'+
                        '<td class="center">'+
                        '<button onclick="updateList('+data.id+')" class="btn btn-success" style="padding: 10px; margin-right: 10px"><i class="fa fa-save"></i> Save</button>'+
                        '<button class="btn btn-danger" onclick="deleteList('+data.id+')" style="padding: 10px;">Delete</button>'+
                        '</td>'+
                        '</tr>';
                    $('#table').append(row);
                },
                error: function (data) {
                    console.log(data);
                }
            })
        }

        function supplier(current, idRow) {
            var id = $(current).val();
//            var supplier = $(current)
            console.log('Supplier : '+id);
            console.log('ID Row: '+idRow);
            $('.barang').empty();
            $.get('{{ url('/getProduk') }}/'+id, function (data) {
                console.log(data);
                $.each(data, function (index, element) {
                    $('.barang').append("<button onclick='produk(this,"+idRow+")' id='"+element.id+"' class='btn btn-block btn-danger produk' data-dismiss='modal' value='"+element.harga+"' name='"+element.nama_produk+"' data-content='"+id+"'>"+element.nama_produk+"</button>");
                });
            });
        }

        function produk(current, id) {
            var name = $(current).attr('name');
            var price = $(current).val();
            var supplier = $(current).attr('data-content');
            console.log(supplier);
            $('.nama-produk'+id).attr('value', name);
            $('.harga'+id).attr('value', price);
            $('#supplier'+id).attr('value', supplier);
            console.log(id);
        }

        function updateList(id) {
            var form = {
                supplier: $('.supplier'+id).val(),
                nama: $('.nama-produk'+id).val(),
                harga: $('.harga'+id).val()
            };
            console.log(form);
//            console.log($('.id_produk').val());
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/updateList/' + id,
                data: form,
                success: function (data) {
                    console.log('Success');
                    var row = ''+
                        '<tr class="row-category'+data.id+'">' +
                        '<td style="vertical-align: middle;">'+data.supplier+'</td>'+
                        '<td style="vertical-align: middle">'+data.nama_produk+'</td>'+
                        '<td style="vertical-align: middle">Rp '+data.harga+'</td>'+
                        '<td style="text-align: center">'+
                        '<button class="btn btn-warning" style="margin-right: 14px" onclick="editList('+data.id+')">Edit</button>'+
                        '<button class="btn btn-danger">Delete</button>'+
                        '</td>'+
                        '</tr>';
                    $('.row-category'+id).replaceWith(row);
//                    window.location.href = '/home';
                },
                error: function (data) {
                    console.log(data);
                }
            })
        }
        
        function editList(id) {
            console.log(id);
            $.ajax({
                type: 'GET',
                url: '/editList/' + id,
                success: function (data) {
                    console.log(data);
                    var row = ''+
                        '<tr class="row-category'+data.id+'">' +
                        '<td style="vertical-align: middle;">' +
                        '<select class="supplier'+data.id+' form-control" onchange="supplier(this, '+data.id+')">' +
                            @foreach($supplier as $item)
                                '<option value="{{ $item->name }}">{{ $item->name }}</option>'+
                            @endforeach
                                '</select>' +
                        '</td>'+
                        '<td style="vertical-align: middle">' +
                        '<input type="text" name="name" class="form-input nama-produk'+data.id+'" data-toggle="modal" data-target="#myModal" value="" required>' +
                        '<input type="hidden" id="supplier'+data.id+'" value="'+data.supplier+'">' +
                        '</td>'+
                        '<td style="vertical-align: middle"><input type="text" name="price" class="form-input harga'+data.id+'" value="" required></td>'+
                        '<td class="center">'+
                        '<button onclick="updateList('+data.id+')" class="btn btn-success" style="padding: 10px"><i class="fa fa-save"></i> Save</button>'+
                        '</td>'+
                        '</tr>';
                    $('.row-category'+id).replaceWith(row);
                }
            })
        }

        function deleteList(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this imaginary file!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                },
                function() {
                    // window.location = ''
                    $.ajax({
                        type: 'POST',
                        url: '/deleteList/' + id,
                        success: function (data) {
                            console.log(data);
                            swal("Deleted!", "Your imaginary file has been deleted.", "success");
                            $('.row-category'+id).remove()
                        },
                        error: function (data) {
                            console.log('Error : ' + data);
                        }
                    });
                }
            );
        }

    </script>
</head>
<body>
    <div id="header">
    <div class="header-content">
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-3">
                    <h3>ASSIGNMENT</h3>
                </div>
                <div class="col-sm-5 col-sm-offset-4">
                    <ul class="pull-right">
                        @if(Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                            <li class="dropdown pull-right"><a href="#" onclick="myFunction()">{{ Auth::user()->name }} <i class="fa fa-caret-down"></i> </a>
                                <ul id="myDropdown" class="dropdown-content pull-right">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                            Sign Out
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container">
        @yield('content')
    </div>

    <div id="footer">
        Copyright@assignment-putri-2017
    </div>
    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}"></script>--}}
</body>
</html>
