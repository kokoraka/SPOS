(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? factory(require('jquery')) :
  typeof define === 'function' && define.amd ? define(['jquery'], factory) :
  (factory(global.jQuery));
}(this, (function ($) {

  'use strict';

  $.fn.datepicker.languages['id-ID'] = {
    format: 'dd/mm/yyyy',
    days: ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'],
    daysShort: ['Ming','Sen','Sel','Rab','Kam','Jum','Sab'],
    daysMin: ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],
    weekStart: 1,
    months: ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
    monthsShort: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des']
  };

})));
