@inject('SalesInvoice','App\Http\Controllers\SalesInvoiceController' )
@extends('adminlte::page')

@section('title', 'MOZAIC Point of Sales')
@section('js')
<script>
    function function_elements_add(name, value){
        // console.log("name " + name);
        // console.log("value " + value);
		// $.ajax({
		// 		type: "POST",
		// 		url : "{{route('add-elements-purchase-return')}}",
		// 		data : {
        //             'name'      : name, 
        //             'value'     : value,
        //             '_token'    : '{{csrf_token()}}'
        //         },
		// 		success: function(msg){
		// 	}
		// });
	}

    $(document).ready(function(){
        $("#item_unit_price").change(function(){
            var unit_price = $("#item_unit_price").val();
            var quantity   = $('#quantity').val();
            var subtotal_amount = unit_price * quantity;

            $("#subtotal_amount").val(subtotal_amount);
            $("#subtotal_amount_view").val(toRp(subtotal_amount));
        });

        $("#quantity").change(function(){
            var unit_price = $("#item_unit_price").val();
            var quantity   = $('#quantity').val();
            var subtotal_amount = unit_price * quantity;

            $("#subtotal_amount").val(subtotal_amount);
            $("#subtotal_amount_view").val(toRp(subtotal_amount));
        });

        $("#quantity").change(function(){
            var unit_price = $("#item_unit_price").val();
            var quantity   = $('#quantity').val();
            var subtotal_amount = unit_price * quantity;

            $("#subtotal_amount_after_discount").val(subtotal_amount);
            $("#subtotal_amount_after_discount_view").val(toRp(subtotal_amount));
        });

        $('#discount_percentage').change(function(){
            var subtotal_amount = $("#subtotal_amount").val();
            var discount_percentage = $("#discount_percentage").val();
            var discount_amount = (discount_percentage * subtotal_amount) / 100;
            var subtotal_amount_after_discount = subtotal_amount - discount_amount;

            $("#discount_amount").val(discount_amount);
            $("#discount_amount_view").val(toRp(discount_amount));
            $("#subtotal_amount_after_discount").val(subtotal_amount_after_discount);
            $("#subtotal_amount_after_discount_view").val(toRp(subtotal_amount_after_discount));
        });

        $("#discount_percentage_total").change(function(){
            var discount_percentage_total = $("#discount_percentage_total").val();
            var subtotal_amount1 = $("#subtotal_amount1").val();
            var discount_amount_total = (discount_percentage_total * subtotal_amount1) / 100;
            var total_amount = subtotal_amount1 - discount_amount_total;

            $("#discount_amount_total").val(discount_amount_total);
            $("#discount_amount_total_view").val(toRp(discount_amount_total));
            $("#total_amount").val(total_amount);
            $("#total_amount_view").val(toRp(total_amount));
        });

        $("#paid_amount").change(function(){
            var paid_amount = $("#paid_amount").val();
            var total_amount = $("#total_amount").val();
            var change_amount = paid_amount - total_amount - total_amount*0.11;

            $("#change_amount").val(change_amount);
            $("#change_amount_view").val(toRp(change_amount));
        });
    });

    function processAddArraySalesInvoice(){
        var item_category_id		        = document.getElementById("item_category_id").value;
        var item_id		                    = document.getElementById("item_id").value;
        var item_unit_id		            = document.getElementById("item_unit_id").value;
        var item_unit_price		            = document.getElementById("item_unit_price").value;
        var quantity                        = document.getElementById("quantity").value;
        var subtotal_amount                 = document.getElementById("subtotal_amount").value;
        var discount_percentage             = document.getElementById("discount_percentage").value;
        var discount_amount                 = document.getElementById("discount_amount").value;
        var subtotal_amount_after_discount  = document.getElementById("subtotal_amount_after_discount").value;

        $.ajax({
            type: "POST",
            url : "{{route('add-array-sales-invoice')}}",
            data: {
                'item_category_id'                  : item_category_id,
                'item_id'    		                : item_id, 
                'item_unit_id'                      : item_unit_id,
                'item_unit_price'                   : item_unit_price,
                'quantity'                          : quantity,
                'subtotal_amount'                   : subtotal_amount,
                'discount_percentage'               : discount_percentage,
                'discount_amount'                   : discount_amount,
                'subtotal_amount_after_discount'    : subtotal_amount_after_discount,
                '_token'                            : '{{csrf_token()}}'
            },
            success: function(msg){
                location.reload();
            }
        });
    }

    function reset_add(){
		$.ajax({
				type: "GET",
				url : "{{route('add-reset-sales-invoice')}}",
				success: function(msg){
                    location.reload();
			}

		});
	}
</script>
@stop
@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('sales-invoice') }}">Daftar Penjualan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Penjualan</li>
    </ol>
  </nav>

@stop

@section('content')

<h3 class="page-title">
    Form Tambah Penjualan
</h3>
<br/>
@if(session('msg'))
<div class="alert alert-info" role="alert">
    {{session('msg')}}
</div>
@endif

@if(count($errors) > 0)
<div class="alert alert-danger" role="alert">
    @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
    @endforeach
</div>
@endif
    <div class="card border border-dark">
    <div class="card-header border-dark bg-dark">
        <h5 class="mb-0 float-left">
            Form Tambah
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('sales-invoice') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>  Kembali</button>
        </div>
    </div>
    
    <?php 
            // if (empty($coresection)){
                //     $coresection['section_name'] = '';
                // }
                ?>

<form method="post" action="{{ route('process-add-sales-invoice') }}" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="row form-group">
            <div class="col-md-6">
                <div class="form-group">
                    <a class="text-dark">Tanggal Invoice Penjualan<a class='red'> *</a></a>
                    <input style="width: 40%" class="form-control input-bb" name="sales_invoice_date" id="sales_invoice_date" type="date" autocomplete="off" value="{{ $date }}"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <a class="text-dark">Nama Pelanggan<a class='red'> *</a></a>
                    {!! Form::select('customer_id', $customers,  0, ['class' => 'selection-search-clear select-form', 'id' => 'customer_id', 'name' => 'customer_id']) !!}
                </div>
            </div>
            
                <h6 class="col-md-8 mt-4 mb-3"><b>Data Retur Pembelian Barang</b></h6>

                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Nama Kategori Barang<a class='red'> *</a></a>
                        {!! Form::select('item_category_id', $categorys, 0, ['class' => 'selection-search-clear select-form', 'id' => 'item_category_id', 'name' => 'item_category_id']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Nama Barang<a class='red'> *</a></a>
                        {!! Form::select('item_id', $items, 0, ['class' => 'selection-search-clear select-form', 'id' => 'item_id', 'name' => 'item_id']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Satuan Barang<a class='red'> *</a></a>
                        {!! Form::select('item_unit_id', $units, 0, ['class' => 'selection-search-clear select-form', 'id' => 'item_unit_id', 'name' => 'item_unit_id']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Harga Per Barang<a class='red'> *</a></a>
                        <input class="form-control input-bb" name="item_unit_price" id="item_unit_price" type="text" autocomplete="off" value=""/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Quantity<a class='red'> *</a></a>
                        <input class="form-control input-bb" name="quantity" id="quantity" type="text" autocomplete="off" value=""/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Subtotal<a class='red'> *</a></a>
                        <input style="text-align: right" class="form-control input-bb" name="subtotal_amount_view" id="subtotal_amount_view" type="text" autocomplete="off" value="" disabled/>
                        <input class="form-control input-bb" name="subtotal_amount" id="subtotal_amount" type="text" autocomplete="off" value="" hidden/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Diskon (%)<a class='red'> *</a></a>
                        <input class="form-control input-bb" name="discount_percentage" id="discount_percentage" type="text" autocomplete="off" value=""/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Jumlah Diskon<a class='red'> *</a></a>
                        <input style="text-align: right" class="form-control input-bb" name="discount_amount_view" id="discount_amount_view" type="text" autocomplete="off" value="" readonly/>
                        <input class="form-control input-bb" name="discount_amount" id="discount_amount" type="text" autocomplete="off" value="" hidden/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Subtotal st Diskon<a class='red'> *</a></a>
                        <input style="text-align: right" class="form-control input-bb" name="subtotal_amount_after_discount_view" id="subtotal_amount_after_discount_view" type="text" autocomplete="off" value="" disabled/>
                        <input class="form-control input-bb" name="subtotal_amount_after_discount" id="subtotal_amount_after_discount" type="text" autocomplete="off" value="" hidden/>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <div class="form-actions float-right">
                <a  type="submit" name="Save" class="btn btn-primary" title="Save" onclick="processAddArraySalesInvoice()"> Tambah</a>
            </div>
        </div>
    </div>
    </div>

    <div class="card border border-dark">
        <div class="card-header border-dark bg-dark">
            <h5 class="mb-0 float-left">
                Daftar
            </h5>
        </div>
        <div class="card-body">
            <div class="form-body form">
                <div class="table-responsive">
                    <table class="table table-bordered table-advance table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th style='text-align:center'>Barang</th>
                                <th style='text-align:center'>Quantity</th>
                                <th style='text-align:center'>Harga</th>
                                <th style='text-align:center'>Subtotal</th>
                                <th style='text-align:center'>Discount (%)</th>
                                <th style='text-align:center'>Total</th>
                                <th style='text-align:center'>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $subtotal_item              = 0;
                            $subtotal_amount            = 0;
                            $discount_percentage_total  = 0;
                            $discount_amount_total      = 0;
                            $total_amount               = 0;
                                if (!is_array($arraydatases)) {
                                    echo "<tr><th colspan='7' style='text-align  : center !important;'>Data Kosong</th></tr>";
                                } else {
                                    foreach ($arraydatases as $key => $val) {
                                        echo "
                                        <tr>
                                            <td style='text-align  : left !important;'>". $SalesInvoice->getItemName($val['item_id'])."</td>
                                            <td style='text-align  : right !important;'>".$val['quantity']."</td>
                                            <td style='text-align  : right !important;'>".number_format($val['item_unit_price'],2,'.',',')."</td>
                                            <td style='text-align  : right !important;'>".number_format($val['subtotal_amount'],2,'.',',')."</td>
                                            <td style='text-align  : right !important;'>".$val['discount_percentage']."</td>
                                            <td style='text-align  : right !important;'>".number_format($val['subtotal_amount_after_discount'],2,'.',',')."</td>
                                        ";
                                        ?>
                                        <td style='text-align  : center'>
                                            <a href="{{route('delete-array-sales-invoice', ['record_id' => $key])}}" name='Reset' class='btn btn-danger btn-sm' onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?')"></i> Hapus</a>
                                        </td>
                                        <?php 

                                        $subtotal_item += $val['quantity'];
                                        $subtotal_amount += $val['subtotal_amount_after_discount'];

                                    }
                                }  
                            ?>
                            <tr>
                                <th colspan="3">Sub Total</th>
                                <td style='text-align  : right !important;'>
                                    <input type="text" style="text-align  : right !important;" class="form-control input-bb" name="subtotal_item" id="subtotal_item" value="{{ $subtotal_item }}" readonly/>
								</td>
                                <td style='text-align  : right !important;'>
                                    <input type="text" style="text-align  : right !important;" class="form-control input-bb" name="subtotal_amount1_view" id="subtotal_amount1_view" value="{{ number_format($subtotal_amount,2,'.',',') }}" readonly/>
                                    <input type="text" style="text-align  : right !important;" class="form-control input-bb" name="subtotal_amount1" id="subtotal_amount1" value="{{ $subtotal_amount }}" hidden/>
								</td>
                            </tr>
                            <tr>
                                <th colspan="3">Diskon (%)</th>
                                <td style='text-align  : right !important;'>
                                    <input type="text" style="text-align  : right !important;" class="form-control input-bb" name="discount_percentage_total" id="discount_percentage_total" value="" autocomplete="off"/>
								</td>
                                <td style='text-align  : right !important;'>
                                    <input type="text" style="text-align  : right !important;" class="form-control input-bb" name="discount_amount_total_view" id="discount_amount_total_view" value="" readonly/>
                                    <input type="text" style="text-align  : right !important;" class="form-control input-bb" name="discount_amount_total" id="discount_amount_total" value="" hidden/>
								</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="3">PPN (%)</th>
                                <td style='text-align  : right !important;'>
                                    <input type="text" style="text-align  : right !important;" class="form-control input-bb" name="subtotal_item" id="subtotal_item" value="{{ 11 }}" readonly/>
                                </td>
                                <td style='text-align  : right !important;'>
                                    <input type="text" style="text-align  : right !important;" class="form-control input-bb" name="subtotal_amount1_view" id="subtotal_amount1_view" value="{{ number_format($subtotal_amount*0.11,2,'.',',') }}" readonly/>
                                    <input type="text" style="text-align  : right !important;" class="form-control input-bb" name="subtotal_amount1" id="subtotal_amount1" value="{{ $subtotal_amount }}" hidden/>
								</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="4">Jumlah Total</th>
                                <td style='text-align  : right !important;'>
                                    <input type="text" style="text-align  : right !important;" class="form-control input-bb" name="total_amount_view" id="total_amount_view" value="{{ number_format($subtotal_amount+$subtotal_amount*0.11,2,'.',',') }}" readonly/>
                                    <input type="text" style="text-align  : right !important;" class="form-control input-bb" name="total_amount" id="total_amount" value="{{ $subtotal_amount }}" hidden/>
								</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="4">Bayar</th>
                                <td style='text-align  : right !important;'>
                                    <input type="text" style="text-align  : right !important;" class="form-control input-bb" name="paid_amount" id="paid_amount" value=""/>
								</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="4">Kembalian</th>
                                <td style='text-align  : right !important;'>
                                    <input type="text" style="text-align  : right !important;" class="form-control input-bb" name="change_amount_view" id="change_amount_view" value="" readonly/>
                                    <input type="text" style="text-align  : right !important;" class="form-control input-bb" name="change_amount" id="change_amount" value="" hidden/>
								</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <div class="form-actions float-right">
                <button type="reset" name="Reset" class="btn btn-danger" onclick="reset_add();"><i class="fa fa-times"></i> Reset Data</button>
                <button type="submit" name="Save" class="btn btn-primary" title="Save"><i class="fa fa-check"></i> Simpan</button>
            </div>
        </div>
    </div>
</form>




@stop

@section('footer')
    
@stop

@section('css')
    
@stop