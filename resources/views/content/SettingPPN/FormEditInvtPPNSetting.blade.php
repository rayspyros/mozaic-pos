@extends('adminlte::page')

@section('title', 'MOZAIC Point of Sales')
@section('js')

@stop
@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('ppn-setting') }}">Daftar Setting PPN</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ubah Setting PPN</li>
    </ol>
  </nav>

@stop

@section('content')

<h3 class="page-title">
    Form Ubah Setting PPN
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
@endif
</div>
    <div class="card border border-dark">
    <div class="card-header border-dark bg-dark">
        <h5 class="mb-0 float-left">
            Form Ubah
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

    <form method="post" action="/ppn-setting/process-edit-ppn-setting" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Kode Setting PPN<a class='red'> *</a></a>
                        <input class="form-control input-bb" name="setting_code" id="setting_code" type="text" autocomplete="off" value="{{ $data['ppn_setting_code'] }}{{ old('setting_code') }}"/>
                        <input class="form-control input-bb" name="setting_id" id="setting_id" type="text" autocomplete="off" value="{{ $data['ppn_setting_id'] }}" hidden/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Nama PPN<a class='red'> *</a></a>
                        <input class="form-control input-bb" name="setting_name" id="setting_name" type="text" autocomplete="off" value="{{ $data['ppn_setting_name'] }}{{ old('setting_name') }}"/>
                    </div>
                </div>
                <div class="col-md-8 mt-3">
                    <div class="form-group">
                        <a class="text-dark">Nilai PPN (%)<a class='red'> *</a></a>
                        <input class="form-control input-bb" name="setting_value" id="setting_value" type="text" autocomplete="off" value="{{ $data['ppn_setting_value'] }}{{ old('setting_value')}}"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <div class="form-actions float-right">
                <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i class="fa fa-times"></i> Batal</button>
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