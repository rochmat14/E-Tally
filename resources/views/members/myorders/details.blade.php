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
                  <div class="card-title">{{ $title }}</div>
               </div>
               <div class="card-body">
                  



   
                    <div class="invoice-header text-right d-block mb-5">
                        <h1 class="invoice-title font-weight-bold text-uppercase mb-1">My Orders Booking Code : {{ $data_booking->booking_code }}</h1>
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

                    <div class="table-responsive mt-4">
                        <table class="table table-bordered border text-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th class="wd-20p">Service</th>
                                    <th class="tx-center">QTY</th>
                                    <th class="tx-right">Unit Price</th>
                                    <th class="tx-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $total = 0;
                                @endphp

                                @foreach($data_service AS $key => $value)
                                <tr>
                                    <td class="font-weight-bold">{{ $value->service_title }}</td>
                                    <td class="tx-center">{{ $value->qty }}</td>
                                    <td class="tx-right">Rp. {{ rupiah($value->price_service) }}</td>
                                    <td class="tx-right">Rp. {{ rupiah($value->amount) }}</td>

                                    @php
                                    $total  += $value->amount;
                                    @endphp
                                </tr>
                                @endforeach
                                <tr>
                                    
                                    <td class="tx-right font-weight-semibold" colspan="3" rowspan="4">Sub-Total</td>
                                    <td class="tx-right font-weight-semibold">Rp. {{ rupiah($total) }}</td>
                                </tr>
                                


                                
                            </tbody>
                        </table>

                        <br><br>
                        
                        <p>
                            Pembayaran Dapat Dilakukan Di Rekening Berikut :
                        </p>

                        <table class="table table-bordered border text-nowrap mb-0">
                            <tr>
                                <th align="center">Nama Bank</th>
                                <th align="center">Nomor Rekening</th>
                                <th align="center">Atas Nama</th>
                            </tr>

                            @foreach($data_bank AS $key => $value)
                            <tr>
                                <td >
                                    <strong>{{ $value->bank_name }}</strong>
                                </td>
                                <td align="center">
                                    <strong>{{ $value->bank_rekening }}</strong>
                                </td>
                                <td align="center">
                                    <strong>{{ $value->atas_nama }}</strong>
                                </td>
                            </tr>
                            @endforeach
                        </table>

                        <br><br>
                        <p>
                            <i>Mohon Informasikan kepada team kami, jika sudah melakukan pembayaran.</i>
                        </p>

                        <div class="main-profile-contact-list d-lg-flex">
                            <div class="media mr-4">
                                <div class="media-icon bg-primary-transparent text-primary mr-3 mt-1">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Phone / Whatsapp</small>
                                    <div class="font-weight-bold">
                                        {!! phone_link() !!}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="media">
                                <div class="media-icon bg-info-transparent text-info mr-3 mt-1">
                                    <i class="fa fa-map"></i>
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Office Address</small>
                                    <div class="font-weight-bold">
                                        {!! office_address() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="float-right" id="printPageButton">
                        <a href="{{ url('members/my_orders') }}" class="btn btn-default mt-4">
                            <i class="si si-back"></i>
                            Back List Orders
                        </a>
                       
                        <button type="button" class="btn btn-info mt-4" onClick="javascript:window.print();"><i class="si si-printer"></i> Print Invoice</button>
                    </div>

        




               </div>
            </div>
         </div>
      </div>
   </div>
</div>


@endsection
