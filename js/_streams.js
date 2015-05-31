$(document).ready(function($) {
  $('#channels').hide();

  var channelList = "nerdist,thenexxx,calebhart42,lavsr,bmoregaming,azprojectmelee,waffru,sandiegopm,ssbmontreal,windycitysmash,hitboxarena,smashinggrounds,projectmcentral,xfawkward,projectmanchester,southernutahsmash,camtendo";
  var channelArray = channelList.split(',');
  var msg;
  var streamCount = 1;
  var pass = 0;
    $.getJSON('https://api.twitch.tv/kraken/streams?channel='+channelList+'&callback=?', function(data) {
        if (data.streams.length < 1){
          msg = "<h4>Nobody's streaming right now.</h4>";
          $('#channels').before(msg);
          $('#streams').hide();
          $('#channels').show();
        }
        else{

          for (var i = 0; i < data.streams.length; i++) {
            var channel = data.streams[i].channel.name;
            var game = data.streams[i].game;
            var viewers = data.streams[i].viewers;
            var followers = data.streams[i].channel.followers;
            var preview = data.streams[i].preview.medium;

            var url = "<a href='http://www.twitch.tv/"+channel+"'>"+channel+"</a>";

            msgOpen = "<div class='well well-sm'>";
            msgChan = "<span class='glyphicon glyphicon-facetime-video'></span> "+url;
            msgVwr = " <span class='view-info'><span class='glyphicon glyphicon-eye-open'></span> "+viewers;
            msgFlw = " <span class='glyphicon glyphicon-user'></span> "+followers+"</span>";
            msgPrv = "<a href='http://www.twitch.tv/"+channel+"'><img src='"+preview+"' alt='Twitch Stream Preview' /></a>";
            msgClose = "</div>";

            var rightInfoBox = msgOpen+msgChan+msgVwr+msgFlw+msgPrv+msgClose;
            var mainInfoBox = msgOpen+msgChan+msgVwr+msgFlw+msgClose;

            if (pass < streamCount){
              var videoWidth = $('#player').width();
              $('#player').height(videoWidth * (9/16));
              var videoHeight = $('#player').height();

              var vid = "<iframe src='http://www.twitch.tv/"+channel+"/embed' frameborder='0' scrolling='no' ></iframe>";
              //var chat = "<iframe src='http://www.twitch.tv/"+channel+"/chat?popout=' frameborder='0' scrolling='no' height='378' width='300'></iframe>";
              var chat;
              msg = vid;
              $('#player').before(mainInfoBox);
              $('#player').append(msg);
            }
            else {

              $('#live-streams').append(rightInfoBox);
            }

            pass ++;
          }
        }

    });
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
