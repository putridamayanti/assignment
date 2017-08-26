@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box">
                <h1>List Product</h1>
                <button class="btn" onclick="addRow()" style="margin-bottom: 15px"><i class="fa fa-plus"></i> Add New</button>
                <table id="table" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="25%">Supplier</th>
                        <th width="25%">Product</th>
                        <th width="25%">Price</th>
                        <th width="20%">Opsi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($produk as $index => $item)
                        <tr class="row-category{{ $item->id }}">
                            <td style="vertical-align: middle;">{{ $item->supplier }}</td>
                            <td style="vertical-align: middle;">{{ $item->nama_produk }}</td>
                            <td style="vertical-align: middle;">Rp {{ $item->harga }}</td>
                            <td style="vertical-align: middle; text-align: center">
                                <button class="btn btn-warning mr10" onclick="editList({{ $item->id }})">Edit</button>
                                <button class="btn btn-danger" onclick="deleteList({{ $item->id }})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    {{--<tr>--}}
                    {{--<td></td>--}}
                    {{--<td>--}}
                    {{--<select name="supplier" class="supplier">--}}
                    {{--<option>Nama Supplier</option>--}}
                    {{--@foreach($supplier as $item)--}}
                    {{--<option value="{{ $item->id }}">{{ $item->name }}</option>--}}
                    {{--@endforeach--}}
                    {{--</select>--}}
                    {{--</td>--}}
                    {{--<td>--}}
                    {{--<input id="nama-produk" type="text" name="name" class="form-input" data-toggle="modal" data-target="#myModal">--}}
                    {{--<input type="hidden" id="id_produk">--}}
                    {{--</td>--}}
                    {{--<td><input id="harga" type="number" name="price" class="form-input"></td>--}}
                    {{--<td><button class="btn btn-green" onclick="addList()"><i class="fa fa-save"></i> Save</button></td>--}}
                    {{--</tr>--}}
                    </tbody>
                </table>

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">List Product</h4>
                            </div>
                            <div class="modal-body">
                                <div class="barang"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
