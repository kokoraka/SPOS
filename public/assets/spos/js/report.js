
function reports(type, method) {
  /* DEFINING REPORT */
  var report = new jsPDF('landscape');
  report.setProperties({
      title: 'Laporan SPOS',
      subject: 'Laporan SPOS',
      author: 'Raka Suryaardi Widjaja',
      keywords: 'simple, point, of, sales, report',
      creator: 'toor'
  });
  report.setFont('helvetica', 'normal');
  report.setFontSize(10);
  /* DEFINING REPORT */


  if (type && method) {
    var settings = {
      name : 'default.pdf',
      path : document.body,
      margins : {
        top: 10,
        bottom: 10,
        left: 10,
        width: 170
      }
    };

    switch (type) {
      case 'items':
        settings.name = 'laporan-data-barang.pdf';
        settings.path = $("#items-report").contents().find('#content-report').html();
      break;
      case 'incomes':
        settings.name = 'laporan-pendapatan.pdf';
        settings.path = $("#incomes-report").contents().find('#content-report').html();
      break;
      default:
    }

    report.fromHTML(
      settings.path,
      settings.margins.left,
      settings.margins.top, {
        'width': settings.margins.width,
      }, function(dispose) {
        switch (method) {
          case 'print':
            report.autoPrint();
          break;
          default:
        }
        report.save(settings.name);
      }, settings.margins
    );

  }
}

$(document).ready(function() {
  $('#report-items-download').on('click', function() {
    reports('items', 'download');
  });

  $('#report-items-print').on('click', function() {
    reports('items', 'print');
  });

  $('#report-incomes-view').on('click', function() {
    var path = _URL + '/report/incomes/view';
    if ($('#datepicker-start, #datepicker-end').length > 0) {
      if ($('#datepicker-start').val() && $('#datepicker-start').val()) {
        path = _URL + '/report/incomes/view/' + $('#datepicker-start').val() + '/' + $('#datepicker-end').val();
      }
      window.open(path, '_blank');
    }
  });

  $('#report-incomes-download').on('click', function() {
    reports('incomes', 'download');
  });

  $('#report-incomes-print').on('click', function() {
    reports('incomes', 'print');
  });

  if ($('#datepicker-start, #datepicker-end').length > 0) {
    $('#datepicker-start, #datepicker-end').on('change', function() {
      $("#incomes-report").contents().find('#content-report').html('');
      $("#incomes-report").attr("src", _URL + '/report/incomes/view/' + $('#datepicker-start').val() + '/' + $('#datepicker-end').val());
    });
  }

});
