@extends('adminlte::page')

@section('title', 'MOZAIC Point of Sales')
@section('js')
<script>
    function function_elements_add(name, value){
        console.log("name " + name);
        console.log("value " + value);
		$.ajax({
				type: "POST",
				url : "{{route('elements-add-setting')}}",
				data : {
                    'name'      : name, 
                    'value'     : value,
                    '_token'    : '{{csrf_token()}}'
                },
				success: function(msg){
			}
		});
	}

    function reset_add(){
		$.ajax({
				type: "GET",
				url : "{{route('add-reset-setting')}}",
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
        <li class="breadcrumb-item"><a href="{{ url('ppn-setting') }}">Daftar Setting PPN</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Setting PPN</li>
    </ol>
  </nav>

@stop

@section('content')

<h3 class="page-title">
    Form Tambah Setting PPN
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
            <button onclick="location.href='{{ url('ppn-setting') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>  Kembali</button>
        </div>
    </div>

    <?php 
            // if (empty($coresection)){
            //     $coresection['section_name'] = '';
            // }
        ?>

    <form method="post" action="{{ route('process-add-ppn-setting') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Kode Setting PPN<a class='red'> *</a></a>
                        <input class="form-control input-bb" name="ppn_setting_code" id="setting_code" type="text" autocomplete="off" onchange="function_elements_add(this.name, this.value);" value="{{ $datasetting['ppn_setting_code'] ?? '' }}"/>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Nama Setting PPN<a class='red'> *</a></a>
                        <input class="form-control input-bb" name="ppn_setting_name" id="setting_name" type="text" autocomplete="off" onchange="function_elements_add(this.name, this.value);" value="{{ $datasetting['ppn_setting_name'] ?? ''}}"/>
                    </div>
                </div>
                <div class="col-md-8 mt-3">
                    <div class="form-group">
                        <a class="text-dark">Nilai PPN<a class='red'> *</a></a>
                        <input class="form-control input-bb" name="ppn_setting_value" id="setting_value" type="text" autocomplete="off" onchange="function_elements_add(this.name, this.value);" value="{{ $datasetting['ppn_setting_value'] ?? ''}}"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <div class="form-actions float-right">
                <button type="reset" name="Reset" class="btn btn-danger" onclick="reset_add();"><i class="fa fa-times"></i> Batal</button>
                <button type="submit" name="Save" class="btn btn-primary" title="Save"><i class="fa fa-check"></i> Simpan</button>
            </div>
        </div>
    </div>
    </div>
</form>

@stop

@section('footer')
    
@stop

@section('css')
    
@stop