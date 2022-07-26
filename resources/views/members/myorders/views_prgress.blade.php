@extends('layouts.members.app')
@php 
    $assets = asset('template_assets');
@endphp

@section('vendor_css')

<style type="text/css">
    @media print {
      #printPageButton {
        display: none;
      }

      .horizontal-main{
        display: none;
      }
    }
</style>


@endsection

@section('vendor_js')



@endsection

@section('js_scripts')

@endsection

@section('content')


<div class="app-content page-body">
   <div class="container">
      <div class="page-header">
         <div class="page-leftheader">
            <h4 class="page-title">{{ $title }}</h4>
         </div>
         <div class="page-rightheader ml-auto d-lg-flex d-none">
            <ol class="breadcrumb">
               <li class="breadcrumb-item">
                  <a href="{{ route('dashboard.index') }}" class="d-flex">
                     <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                        <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                     </svg>
                     <span class="breadcrumb-icon"> Home</span>
                  </a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <div class="card-title">Progress Orders | {{ $title }}</div>
               </div>
               <div class="card-body">
                  



   
                    <div class="invoice-header text-right d-block mb-5">
                        <h3 class="invoice-title font-weight-bold text-uppercase mb-1">Progress Orders | Booking Code : {{ $data_booking->booking_code }}</h3>
                    </div><!-- invoice-header -->
                    <div class="row mt-4">
                        <div class="col-md">
                            <img src="/images/logo/{{ AppLogo() }}" alt="Responsive image" class="img-fluid" style="width: 200px; margin-top: -70px; margin-left: -45px;">
                            <br>
                            <br>
                            
                            <strong>Dear {{ $data_booking->nama }}</strong> <br>
                            <div class="billed-to">
                                
                                Terimakasih Telah melakukan order terkait  :
                                <strong>
                                    {{ $data_booking->type_booking }}
                                </strong>

                                <ul>
                                @if($data_booking->type_booking =='kendaraan')
                                {{-- pengiriman kendaraan --}}
                                    
                                    <li class="">
                                        - Merk Kendaraan : <strong>{{ $data_booking->merk }}</strong>
                                    </li>
                                    <li class="">
                                        - Model Kendaraan : <strong>{{ $data_booking->model }}</strong>
                                    </li>
                                    <li class="">
                                        - Tahun Kendaraan : <strong>{{ $data_booking->kendaraan_tahun }}</strong>
                                    </li>
                                    <li class="">
                                        - Kondisi Kendaraan : <strong>{{ $data_booking->kendaraan_kondisi }}</strong>
                                    </li>
                                    <li class="">
                                        - Kendaraan Bisa Dioperasikan ? : <strong>{{ $data_booking->kendaraan_dikendarai }}</strong>
                                    </li>

                                @elseif($data_booking->type_booking =='kontainer')
                                    {{-- pengiriman kontainer --}}
                                    <li class="">
                                        - Type Kontainer : <strong>{{ $data_booking->type_kontainer }}</strong>
                                    </li>
                                    <li class="">
                                        - Jumlah Kontainer : <strong>{{ $data_booking->kontainer_jumlah }} Kontainer</strong>
                                    </li>
                                    <li class="">
                                        - Kemasan Barang : <strong>{{ $data_booking->kontainer_kemasan_barang }}</strong>
                                    </li>
                                @endif
                                </ul>



                            </div>
                        </div>
                        <div class="col-md">
                            <div class="billed-from text-md-right">
                                <label class="font-weight-bold">Kode Booking </label> :  <strong>
                                    {{ $data_booking->booking_code }}
                                </strong>
                                
                                <ul>

                                    <li>Atas Nama : <strong>{{ $data_booking->nama }}</strong></li>
                                    <li>Nama Pengiriman : <strong>{{ $data['type_booking'] }}</strong></li>
                                    <li>Pengiriman  Dari : <strong>{{ $data['pengirman_dari'] }}</strong></li>
                                    <li>Tujuang Pengiriman : <strong>{{ $data['tujuan_pengiriman'] }}</strong></li>
                                    <li>Layanan Pilihan : <strong>{{ $data['pilihan_layanan'] }}</strong></li>
                                    <li>Pilihan Pengiriman : <strong>{{ $data_booking->waktu_kirim }}</strong></li>
                                </ul>
                            </div><!-- billed-from -->
                        </div>
                    </div>
                    <hr>

                    <table id="table-orders_progress_list" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="wd-20p">No</th>
                            <th class="tx-center">Progress Info</th>
                            <th class="tx-right">Time Progress</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach($data_progress AS $key => $value)

                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $value->progress_name.'&nbsp; | '.$value->progress_description }}</td>
                                <td>{{ $value->progress_time }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>

                    


                    <div class="float-right" id="printPageButton">
                        <a href="{{ url('members/my_orders') }}" class="btn btn-default mt-4">
                            <i class="si si-back"></i>
                            Back List Orders
                        </a>
                       
                        
                    </div>

        




               </div>
            </div>
         </div>
      </div>
   </div>
</div>


@endsection
