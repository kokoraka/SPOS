/* DEFINING REPORT */
var report = new jsPDF('landscape');
//report.addFont('Roboto', 'Roboto', 'Normal');
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

function reportItems(type) {
  if (type) {
    var margins = {
      top: 10,
      bottom: 10,
      left: 10,
      width: 170
    };

    report.fromHTML(
      $("#items-report").contents().find('#content-report').html(),
      margins.left,
      margins.top, {
        'width': margins.width,
      }, function(dispose) {
        switch (type) {
          case 'print':
            report.autoPrint();
          break;
          default:
        }
        report.save('laporan-data-barang.pdf');
      }, margins
    );

  }
}

$(document).ready(function() {
  $('#report-items-download').on('click', function() {
    reportItems('download');
  });

  $('#report-items-print').on('click', function() {
    reportItems('print');
  });
});
