$(document).ready(function($) {
var days = ["sun","mon","tue","wed","thu","fri","sat"]
var today = new Date().getDay();
$('#'+days[today]).parent().addClass('today');

  $.getJSON("https://spreadsheets.google.com/feeds/list/1H4GzwDNup8d0EEQ5nLZ24Xr8gyGgPIEI7dRPZeMf9Rk/default/public/values?alt=json",
    function(data) {

    $.each(data.feed.entry, function(i,entry){
      var mon = entry.gsx$monday.$t;
      var tue = entry.gsx$tuesday.$t;
      var wed = entry.gsx$wednesday.$t;
      var thu = entry.gsx$thursday.$t;
      var fri = entry.gsx$friday.$t;
      var sat = entry.gsx$saturday.$t;
      var sunday = entry.gsx$sunday.$t;
      var monthly = entry.gsx$monthly.$t;
      var biweekly = entry.gsx$biweekly.$t;
      var misc = entry.gsx$misc.$t;

      var stName = entry.gsx$name.$t;
      var stURL = entry.gsx$url.$t;
      var stTime = entry.gsx$time.$t;
      var stZone = entry.gsx$timezone.$t;

      var output = "<a href='"+stURL+"' target='_blank'>"+stName+"</a><div class='chan-time'>";
      if (stTime !== ""){
        output = output + stTime+" "+stZone;
      }
      if (monthly === 'x'){
        output = output + " <em>Monthly</em>";
      }
      if (biweekly === 'x'){
        output = output + " <em>Biweekly</em>";
      } else{}
      output = "<li>"+output+"</div></li>"

      if (mon === 'x'){
        $('#mon').append(output);
      }
      if (tue === 'x'){
        $('#tue').append(output);
      }
      if (wed === 'x'){
        $('#wed').append(output);
      }
      if (thu === 'x'){
        $('#thu').append(output);
      }
      if (fri === 'x'){
        $('#fri').append(output);
      }
      if (sat === 'x'){
        $('#sat').append(output);
      }
      if (sunday === 'x'){
        $('#sun').append(output);
      }
      if (misc === 'x'){
        $('#misc').append(output);
      }

    });
  });
});
