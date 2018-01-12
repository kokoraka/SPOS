/* GLOBE */
var _URL = $('meta[name="_home_"]').attr('content');

function show_status_template(data) {
  var content = '';
  if (data.status && data.status.length > 0) {
    for (i = 0; i < data.status.length; i++) {
      content += '<div class="mdl-cell mdl-cell--middle mdl-cell--4-col mdl-cell--8-col-tablet mdl-cell-4-col-phone">';
      content += '<div id="status-' + data.status[i].id + '" class="mdl-card mdl-shadow--4dp mdl-card-full">';
      content += '<div class="mdl-card__title">';
      content += '<div class="status-text text-center">';
      content += '<div class="status">' + data.status[i].status + '</div>';
      content += '<div class="author">';
      content += '<a class="normalize-link fg-yellow" href="' + _URL + '/author/' + data.status[i].author_slug + '" title="">' + data.status[i].name + '</a>';
      content += '</div>';
      if (data.status[i].year) {
        content += '<div class="year">(' + data.status[i].year + ')</div>';
      }
      content += '</div></div>';

      if (data[i].tags.length > 0) {
        content += '<div class="mdl-card__supporting-text">';
        content += '<div class="text-left">';
        for (j = 0; j < data[i].tags.length; j++) {
          content += '<span class="mdl-chip mdl-chip--contact">';
          content += '<span class="mdl-chip__contact bg-midnight fg-white">#</span>';
          content += '<span class="mdl-chip__text">';
          content += '<a class="normalize-link fg-midnight" href="' + _URL + '/tags/' + data[i].tags[j].slug + '" title="">' + data[i].tags[j].name + '</a>';
          content += '</span></span>';
        }
        content += '</div></div>';
      }

      if (data[i].cats.length > 0) {
        content += '<div class="mdl-card__actions mdl-card--border">';
        content += '<div class="text-left">';
        for (j = 0; j < data[i].cats.length; j++) {
          content += '<span class="mdl-chip">';
          content += '<span class="mdl-chip__text">';
          content += '<a class="normalize-link fg-midnight" href="' + _URL + '/categories/' + data[i].cats[j].slug + '" title="">' + data[i].cats[j].name + '</a>';
          content += '</span></span>';
        }
        content += '</div></div>';
      }

      content += '<div class="mdl-card__actions mdl-card--border">';
      content += '<button class="clipboard mdl-button mdl-js-button mdl-js-ripple-effect fg-midnight" data-clipboard-text="' + data.status[i].status + '">';
      content += '<i class="material-icons">content_copy</i> Copy</button>';
      content += '<button class="clipboard mdl-button mdl-js-button mdl-js-ripple-effect fg-midnight">';
      content += '<i class="material-icons">share</i> Share</button>';
      content += '<a class="clipboard mdl-button mdl-js-button mdl-js-ripple-effect fg-midnight pull-right" href="' + _URL + '/status/' + data.status[i].slug + '">';
      content += 'More <i class="material-icons">more_vert</i></a></div>';
      content += '<div class="mdl-card__menu">';
      content += '<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect fg-white">';
      content += '<i class="material-icons">share</i></button>';
      content += '</div></div></div>';

      var thumb = data.status[i].thumbnail;
      if (!thumb) {
        thumb = 'default.jpg';
      }
      content += '<style>';
        content += '#status-'+ data.status[i].id + ' .mdl-card__title {';
        content += 'color: #ffff;';
        content += 'text-shadow: 4px 4px 4px #000000, 4px 4px 4px #c0392b;';
        content += 'min-height: 350px;';
        content += 'height: 100%;';
        content += 'background: url("' + _URL + '/images/thumbs/' + thumb + '") center / cover;';
        content += '}';
      content += '</style>';
    }
  }
  else {
    content += '<hr />';
  }
  return content;
}

function get_status(url) {
  $.ajax({
    url: url,
    type: "GET",
      beforeSend: function(){
        $('#loader').show();
      },
      complete: function(){
        $('#loader').hide();
      },
      success: function(data){
        $("#status-content").append(show_status_template(data));
      },
      error: function(){
        //uh oh
      }
  });
}

function auto_load_status() {
  if (parseInt($('[name="_count"]').val()) < parseInt($('[name="_max"]').val())) {
    var max = parseInt($('[name="_count"]').val()) + 3;
    get_status('/api/status/json/' + $('[name="_count"]').val() + '/' + max);
    $('[name="_count"]').val(max);
  }
  else {
    $('#load-more').text("Congrats, You reach the end of this page");
    $('#load-more').attr("disabled", true);
  }
}

function criteria_change() {
  var url = '/api/criteria/json/0/6';
  var data = {
    'authors': $('#authors').val(),
    'categories': $('#categories').val(),
    'tags': $('#tags').val(),
    'search': $('#search').val()
  };

  $.ajax({
    url: url,
    type: "GET",
    data: data,
      beforeSend: function(){
        $('#loader').show();
      },
      complete: function(){
        $('#loader').hide();
      },
      success: function(data){
        $("#status-content").html(show_status_template(data));
        $('[name="_count"]').val(data.status.length);
      },
      error: function(){
        //uh oh
      }
  });
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


});
