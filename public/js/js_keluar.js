var req_keluar = null;

$('#form_member_keluar').hide();
$('#type_harga_keluar').hide();
$('[name="text_keterangan_keluar"]').hide();


document.getElementById("input_keluar").onkeyup = function (e){

  id_transaksi = this.value;

  var one = /[^a-zA-Z0-9]+$/g;
  this.value=this.value.replace(one,'');

  if (req_keluar != null) req_keluar.abort();

  $.ajax({
      type: "GET",
      url: "{{ url('kasir_area/get_transaksi_keluar') }}",
      data: {'id_transaksi' : id_transaksi},
      dataType: "JSON",
      success: function(result){

        if(result.status =='member'){
          $('#judul_transaksi_keluar').text(result.pesan); 
          $('#form_member').show();
          $('#type_harga').hide();
          $('[name="status_pelanggan"]').val('member');
          $('[name="member_id"]').val(result.data_member.member_id);
          $('[name="rfid_code"]').val(result.data_member.rfid_code);
          $('[name="no_pol"]').val(result.data_member.no_pol);
          $('[name="member_name"]').val(result.data_member.member_name);
          $('[name="type_name"]').val(result.data_member.type_name);
          $('[name="valid_date"]').val(result.data_member.valid_date);
          $('[name="vendor_name"]').val(result.data_member.vendor_name);
          $('[name="id_type_kendaraan_member"]').val(result.data_member.id_type_kendaraan);

          $('[name="total_bayar"]').val(0);
          $('#total_bayar').text('0.00'); //change button text    



        }else if(result.status =='member_expired'){

          $('#judul_transaksi_keluar').text(result.pesan); 
          $('#form_member').show();
          $('#type_harga').show();
          $('[name="status_pelanggan"]').val('non_member');

          $('[name="member_id"]').val(result.data_member.member_id);
          $('[name="rfid_code"]').val(result.data_member.rfid_code);
          $('[name="no_pol"]').val(result.data_member.no_pol);
          $('[name="member_name"]').val(result.data_member.member_name);
          $('[name="type_name"]').val(result.data_member.type_name);
          $('[name="valid_date"]').val(result.data_member.valid_date);
          $('[name="vendor_name"]').val(result.data_member.vendor_name);
          $('[name="total_bayar"]').val(0);
          $('#total_bayar').text('0.00'); //change button text   


        }else{

          $('#judul_transaksi_keluar').text(result.pesan); 
          $('#form_member').hide();
          $('[name="status_pelanggan"]').val('non_member');
          $('#type_harga').show();
          $('[name="member_id"]').val('');
          $('[name="rfid_code"]').val('');
          $('[name="no_pol"]').val('');
          $('[name="member_name"]').val('');
          $('[name="type_name"]').val('');
          $('[name="valid_date"]').val('');
          $('[name="vendor_name"]').val('');

        }
      }
  });



}