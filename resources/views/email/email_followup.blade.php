

<!DOCTYPE html>
<html>

<head>
    <title>Estimasi Biaya Perhitungan Pengiriman</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
        @media screen {
            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 400;
                src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 700;
                src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 400;
                src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 700;
                src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
            }
        }

        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* MOBILE STYLES */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }
    </style>
</head>

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
    <!-- HIDDEN PREHEADER TEXT -->
    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Lato', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
        Informasi Estimasi Pembiayaan Pengiriman  {{ $return_data['type_booking'] }}
    </div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <!-- LOGO -->
        <tr>
            <td bgcolor="#8bc0e5" align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#8bc0e5" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                            <h1 style="font-size: 20px; font-weight: 400; margin: 2;">
                                Informasi Estimasi Pembiayaan Pengiriman {{ $return_data['booking_code'] }}
                            </h1> 
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 25px;">

                            <p style="margin: 0;">
                                <strong>Dear {{ $return_data['nama'] }}</strong> <br>

                                Terimakasih Telah melakukan order terkait  : <br>
                                <strong>
                                    {{ $return_data['type_booking'] }}
                                </strong>
                                <ul class="list-group list-group-flush">
                                @if($return_data['jenis_booking'] =='kendaraan')
                                {{-- pengiriman kendaraan --}}
                                    
                                    <li class="list-group-item">
                                        Merk Kendaraan : <strong>{{ $return_data['merk'] }}</strong>
                                    </li>
                                    <li class="list-group-item">
                                        Model Kendaraan : <strong>{{ $return_data['model'] }}</strong>
                                    </li>
                                    <li class="list-group-item">
                                        Tahun Kendaraan : <strong>{{ $return_data['kendaraan_tahun'] }}</strong>
                                    </li>
                                    <li class="list-group-item">
                                        Kondisi Kendaraan : <strong>{{ $return_data['kendaraan_kondisi'] }}</strong>
                                    </li>
                                    <li class="list-group-item">
                                        Kendaraan Bisa Dioperasikan ? : <strong>{{ $return_data['kendaraan_dikendarai'] }}</strong>
                                    </li>

                                @elseif($return_data['jenis_booking'] =='kontainer')
                                    {{-- pengiriman kontainer --}}
                                    <li class="list-group-item">
                                        Type Kontainer : <strong>{{ $return_data['type_kontainer'] }}</strong>
                                    </li>
                                    <li class="list-group-item">
                                        Jumlah Kontainer : <strong>{{ $return_data['kontainer_jumlah'] }} Kontainer</strong>
                                    </li>
                                    <li class="list-group-item">
                                        Kemasan Barang : <strong>{{ $return_data['kontainer_kemasan_barang'] }}</strong>
                                    </li>
                                @endif
                                </ul>




                            </p>

                            <br><br>
                            Detail Informasi : <br><br>
                            <br>
                            <table width="100%" cellpadding="1" cellspacing="1" border="1">
                                <tr>
                                    <th>Kode Booking</th>
                                    <td align="center">{{ $return_data['booking_code'] }}</td>
                                </tr>
                                <tr>
                                    <th>Atas Nama</th>
                                    
                                    <td align="center">{{ $return_data['nama'] }}</td>
                                </tr>
                                
                                <tr>
                                    <th>Nama Pengiriman</th>
                                    
                                    <td align="center">{{ $return_data['type_booking'] }}</td>
                                </tr>

                                <tr>
                                    <th>Pengiriman  Dari</th>
                                    
                                    <td align="center">{{ $return_data['pengirman_dari'] }}</td>
                                </tr>

                                <tr>
                                    <th>Tujuang Pengiriman</th>
                                    
                                    <td align="center">{{ $return_data['tujuan_pengiriman'] }}</td>
                                </tr>

                                <tr>
                                    <th>Layanan Pilihan</th>
                                    
                                    <td align="center">{{ $return_data['pilihan_layanan'] }}</td>
                                </tr>

                                <tr>
                                    <th>Pilihan Pengiriman</th>
                                    
                                    <td align="center">{{ $return_data['waktu_kirim'] }}</td>
                                </tr>
                                

                                
                            </table>

                           

                        </td>
                    </tr>
                    

                    <tr>
                        <td bgcolor="#ffffff" style="padding: 20px 30px 40px 30px;">
                            <p>
                                Estimasi Pembiayaan Layanan : 
                            </p>
                            <table width="100%" cellpadding="1" cellspacing="1" border="1">
                                <thead>
                                  <tr>
                                    <th class="wd-20p">No</th>
                                    <th class="wd-20p">Service Title</th>
                                    <th class="tx-center">Qty</th>
                                    <th class="tx-right">Unit Price</th>
                                    <th class="tx-right">Amount</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no =1;
                                    @endphp
                                    
                                    @foreach($data_service as $key => $value)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $value->service_title }}</td>
                                        <td>{{ $value->qty }}</td>
                                        <td>Rp. {{ rupiah($value->price_service) }}</td>
                                        <td>Rp. {{ rupiah($value->amount) }}</td>
                                    </tr>
                                    @endforeach
                                    

                                </tbody>

                            </table>

                            <p>
                                <i>
                                    Sifat Harga Tidak Bersifat fixed, dan bisa di negosiasi lebih lanjut dan disesuaikan kebutuhan secara custom. 
                                </i>
                            </p>

                        </td>
                    </tr>
                    
                    
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Regards,<br>
                            	INB Logistik Team
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>


        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#FFECD1" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Jika menemukan kendala </h2>
                            <p style="margin: 0;"><a href="{{ url('contact-us') }}" target="_blank" style="color: #8bc0e5;">Anda bisa kontak kami segera !</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>