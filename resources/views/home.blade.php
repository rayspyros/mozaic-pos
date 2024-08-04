@extends('adminlte::page')

@section('title', 'MOZAIC Point of Sales')

{{-- @section('content_header')
    
Dashboard

@stop --}}

@section('content')
    
<br>

<div class="card border border-dark">
    <div class="card-header border-dark bg-dark">
        <h5 class="mb-0 float-left">
            Menu Utama
        </h5>
    </div>

    <div class="card-body">
        <div class="row">
            <div class='col-md-6'>
                <div class="card" style="height: auto;">
                    <div class="card-header bg-secondary">
                    Persediaan
                    </div>
                    <div class="card-body">
                    <ul class="list-group">
                    <?php foreach($menus as $menu){
                            if($menu['id_menu']==11){
                    ?>
                        <li class="list-group-item main-menu-item" onClick="location.href='{{route('stock-adjustment')}}'"> <i class="fa fa-angle-right"></i> Stok Penyesuaian</li>
                    <?php }
                            if($menu['id_menu']==11){
                    ?>
                        <li class="list-group-item main-menu-item" onClick="location.href='{{route('stock-adjustment-report')}}'"> <i class="fa fa-angle-right"></i> Laporan Stok Barang</li>
                    <?php   }
                    }   
                    ?> 
                    </ul>
                </div>
                </div>
            </div>
            <div class='col-md-6'>
                <div class="card" style="height: auto;">
                    <div class="card-header bg-info">
                    Pembelian
                    </div>
                    <div class="card-body scrollable">
                        <ul class="list-group">
                        <?php foreach($menus as $menu){
                            if($menu['id_menu']==21){
                        ?>
                            <li class="list-group-item main-menu-item-b" onClick="location.href='{{route('purchase-invoice')}}'"> <i class="fa fa-angle-right"></i> Pembelian</li>          
                        <?php   }
                            if($menu['id_menu']==23){
                        ?> 
                            <li class="list-group-item main-menu-item" onClick="location.href='{{route('purchase-return')}}'"> <i class="fa fa-angle-right"></i> Retur Pembelian</li>
                        <?php 
                            }
                        } 
                        ?>           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class='col-md-6'>
                <div class="card" style="height: auto;">
                    <div class="card-header bg-info">
                    Penjualan
                    </div>
                    <div class="card-body">
                    <ul class="list-group">
                    <?php foreach($menus as $menu){
                        if($menu['id_menu']==31){
                    ?>
                        <li class="list-group-item main-menu-item" onClick="location.href='{{route('sales-invoice')}}'"> <i class="fa fa-angle-right"></i> Penjualan</li>         
                    <?php 
                            }
                        } 
                    ?>                    
                    </ul>
                </div>
                </div>
            </div>
            <div class='col-md-6'>
                <div class="card" style="height: auto;">
                    <div class="card-header bg-secondary">
                    Keuangan
                    </div>
                    <div class="card-body">
                    <ul class="list-group">
                    <?php foreach($menus as $menu){
                            if($menu['id_menu']==41){
                    ?>
                        <li class="list-group-item main-menu-item" onClick="location.href='{{route('acct-account')}}'"> <i class="fa fa-angle-right"></i> No. Perkiraan</li>
                    <?php   }
                            if($menu['id_menu']==42){
                    ?> 
                        <li class="list-group-item main-menu-item" onClick="location.href='{{route('acct-account-setting')}}'"> <i class="fa fa-angle-right"></i> Seting Jurnal</li>      
                    <?php 
                            }
                        } 
                    ?>                        
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </div>
</form>


@stop

@section('css')
    
@stop

@section('js')
    
@stop