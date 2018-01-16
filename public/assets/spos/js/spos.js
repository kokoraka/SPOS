/* GLOBE */
var _URL = $('meta[name="_home_"]').attr('content');
if ($('meta[name="_totals_"]').length > 0) {
  var _TOTALS = $('meta[name="_totals_"]').attr('content');
}

var dateRangeSettings = {
  locale: {
    "format": "YYYY-MM-DD",
  },
};

function reload_orders() {
  var data = {
    '_token': $('[name="_token"]').val()
  };

  $.ajax({
    url: 'api/get/orders',
    type: "GET",
    data: data,
      beforeSend: function(){

      },
      complete: function(){

      },
      success: function(data){
        var res = '';
        if (data.data) {
          for (i = 0; i < data.data.length; i++) {
            res += '<tr>';
            res += '<td>' + data.data[i].nama_barang +'</td>';
            res += '<td>Rp' + data.data[i].harga_barang +'</td>';
            res += '<td>' + data.data[i].jumlah_barang +'</td>';
            res += '<td>Rp' + data.data[i].harga_barang * data.data[i].jumlah_barang +'</td>';
            res += '<td><button type="button" class="btn btn-danger btn-xs" onclick="remove_item(' + data.data[i].kode_barang +');"><i class="fa fa-trash-o"></i> Hapus </button></td>';
            res += '</tr>';
          }
        }
        else {
          res += '<tr class="odd"><td valign="top" colspan="5" class="dataTables_empty">No data available in table</td></tr>';
        }

        $('#datatable-fixed-header tbody').html(res);
        $('#total-transaction').html(data.total);
        $('#item-cash').val(data.max);
        $('meta[name="_totals_"]').attr('content', data.max);
        $('#item-cash').attr('min', data.max);

        var cash_back = $('#item-cash').val() - data.max;
        if (cash_back < 0) {
          cash_back = data.max;
        }

        $('#return-transaction').html('Rp' + cash_back);
      },
      error: function(){

      }
  });
}


function remove_item(id) {
  if (id) {
    var data = {
      '_token': $('[name="_token"]').val(),
      'id': id
    };
    $.ajax({
      url: 'api/remove/item',
      type: "POST",
      data: data,
        beforeSend: function(){

        },
        complete: function(){

        },
        success: function(data){
          reload_orders();
        },
        error: function(){
          //uh oh
        }
    });
  }
}


function reload_image(input, target, type) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      switch (type) {
        case 'bg':
          $(target).css('background-image', 'url(\'' + e.target.result + '\')');
        break;
        default:
          $(target).attr('src', e.target.result);
      }
    };
    reader.readAsDataURL(input.files[0]);
  }
}

$(document).ready(function() {
  if ($('#change-description').length > 0){
    $('#change-description').hide();
  }

  if ($('#change-thumbnail').length > 0){
    $('#change-thumbnail').hide();
  }

  if ($('#identity').length > 0){
    $('#identity').hide();
  }

  if ($('.select2').length > 0){
    $('.select2').select2();
  }

  if ($('#datepicker-start, #datepicker-end').length > 0){
    $('#datepicker-start, #datepicker-end').daterangepicker({
      'locale': dateRangeSettings.locale,
      singleDatePicker: true,
    });
  }

  if ($('#current-time').length > 0){
    $('#current-time').text(moment().format('D MMMM YYYY, H:m:s'));
    setInterval(function() {
      $('#current-time').text(moment().format('D MMMM YYYY, H:m:s'))
    }, 1000);
  }

  if ($('#add-item').length > 0){
    $('#add-item').on('click', function() {
      var data = {
        'id': $('#item-id').val(),
        'qty': $('#item-quantity').val(),
        '_token': $('[name="_token"]').val()
      };
      if (data['qty'] > 0) {
        $.ajax({
          url: 'api/add/item',
          type: "POST",
          data: data,
            beforeSend: function(){

            },
            complete: function(){

            },
            success: function(data){
              reload_orders();
            },
            error: function(){
              //uh oh
            }
        });
      }
    });
  }

  if ($('#reset-transaction').length > 0){
    $('#reset-transaction').on('click', function() {
      var data = {
        '_token': $('[name="_token"]').val()
      };
      $.ajax({
        url: 'api/remove/orders',
        type: "POST",
        data: data,
          beforeSend: function(){

          },
          complete: function(){

          },
          success: function(data){
            reload_orders();
          },
          error: function(){
            //uh oh
          }
      });
    });
  }

  if ($('#item-cash').length > 0 && $('#return-transaction').length > 0) {
    $('#item-cash').on('change', function() {
      var cash_back = $('#item-cash').val() - $('meta[name="_totals_"]').attr('content');
      if (cash_back < 0) {
        cash_back = $('meta[name="_totals_"]').attr('content');
        $('#item-cash').val($('meta[name="_totals_"]').attr('content'));
      }
      $('#return-transaction').html('Rp' + cash_back);
    });
  }

});
