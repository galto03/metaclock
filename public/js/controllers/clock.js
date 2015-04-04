


MetaClockApp.controller('ClockController', function($scope,$interval,Utils,$http) {

    this.bindedAlarmEvents = false;
    $scope.clock = {
        hours: null,
        minutes: null,
        seconds: null,

        updateClock: function() {
            var pad     = function(n) { return (n < 10) ? '0' + n : n; };
            var time    = new Date();
            var hours   = time.getHours();
            var minutes = time.getMinutes();
            var seconds = time.getSeconds();

            hours = (hours > 12 ? hours - 12 : (hours === 0 ? 12 : hours));

            $scope.clock.hours = pad(hours);
            $scope.clock.minutes = pad(minutes);
            $scope.clock.seconds = pad(seconds);
        },

        init: function() {
            $scope.clock.updateClock();
            $interval($scope.clock.updateClock,1000);
        }
    };
    $scope.clock.init();

    var $domPlayer = angular.element(".avgrund-popin .jquery_jplayer_1");
    var bindEvents = function() {
        var $domPlayer = angular.element(".avgrund-popin .jquery_jplayer_1");
        function recreateJPlayer(title,mp3, $obj) {
            $obj.jPlayer("destroy");
            var stream = {
                    title: title,
                    mp3: mp3
                },
                ready = false;

            $obj.jPlayer({
                ready: function (event) {
                    ready = true;
                    $(this).jPlayer("setMedia", stream);
                    $('.jp-play').trigger('click');
                },
                pause: function() {
                    $(this).jPlayer("clearMedia");
                },
                error: function(event) {
                    if(ready && event.jPlayer.error.type === $.jPlayer.error.URL_NOT_SET) {
                        // Setup the media stream again and play it.
                        $(this).jPlayer("setMedia", stream).jPlayer("play");
                    }
                },
                swfPath: "../js/libs/jquery.jplayer.swf",
                supplied: "mp3",
                preload: "none",
                wmode: "window",
                useStateClassSkin: true,
                autoBlur: false,
                keyEnabled: true
            });
        }

        angular.element(".avgrund-popin #tune_chooser li").each(function() {
            $(this).on('click', function() {
                var $this = $(this);

                if ($this.find('i').hasClass('fa-pause'))
                {
                    $domPlayer.jPlayer("destroy");
                } else {

                    var song = $(this).attr('song');
                    var title = $(this).attr('title');
                    recreateJPlayer(title, "../media/" + song, $domPlayer);
                }
                $this.toggleClass('active');
                $this.find('i').toggleClass('fa-pause');

                $this.addClass('chosen');
                angular.element(".avgrund-popin #tune_chooser .song_desc").text($this.attr('title'));
                $this.siblings().removeClass('chosen');
            })
        });

        angular.element(".avgrund-popin .avgrund-close").on("click.destroy_jplayer", function() {
            $domPlayer.jPlayer("destroy");
        });

        angular.element(".avgrund-popin .control_next").on("click", function() {
            $('.avgrund-popin #settings_slider ul li.active').animate({
                marginLeft: '-459px'
            }, 200, function() {
                var $this = $(this);
                $this.next().addClass('active');
                $this.removeClass('active');
            });

            angular.element(".avgrund-popin .avgrund-close").trigger('click.destroy_jplayer');
        });

        $('.clockpicker').clockpicker({
            placement: 'bottom',
            align: 'left',
            donetext: 'Done'
        });



    };

    angular.element(".set_alarm_cont").avgrund({
        width: 512,
        height: 450,
        showClose: true,
        showCloseText: '',
        closeByEscape: false,
        closeByDocument: false,
        holderClass: 'set_alarm_modal rounded5',
        overlayClass: '',
        enableStackAnimation: true,
        onBlurContainer: '',
        openOnEvent: true,
        setEvent: 'click',
        onLoad: function() { $('html,body').css('overflow','hidden','important') },
        onAfterLoad: function (elem) { bindEvents() },
        onUnload: function (elem) {
            $domPlayer.jPlayer("destroy");
            $('html,body').css('overflow','initial', 'important');
        },
        template: angular.element('#alarm_settings_dialog').html()
    });

    var codes_to_wi_icon = {
        0: 'wi-tornado',
        1: 'wi-storm-showers',
        2: 'wi-tornado',
        3: 'wi-thunderstorm',
        4: 'wi-thunderstorm',
        5: 'wi-snow',
        6: 'wi-rain-mix',
        7: 'wi-rain-mix',
        8: 'wi-sprinkle',
        9: 'wi-sprinkle',
        10: 'wi-hail',
        11: 'wi-showers',
        12: 'wi-showers',
        13: 'wi-snow',
        14: 'wi-storm-showers',
        15: 'wi-snow',
        16: 'wi-snow',
        17: 'wi-hail',
        18: 'wi-hail',
        19: 'wi-cloudy-gusts',
        20: 'wi-fog',
        21: 'wi-fog',
        22: 'wi-fog',
        23: 'wi-cloudy-gusts',
        24: 'wi-cloudy-windy',
        25: 'wi-thermometer',
        26: 'wi-cloudy',
        27: 'wi-night-cloudy',
        28: 'wi-day-cloudy',
        29: 'wi-night-cloudy',
        30: 'wi-day-cloudy',
        31: 'wi-night-clear',
        32: 'wi-day-sunny',
        33: 'wi-night-clear',
        34: 'wi-day-sunny-overcast',
        35: 'wi-hail',
        36: 'wi-day-sunny',
        37: 'wi-thunderstorm',
        38: 'wi-thunderstorm',
        39: 'wi-thunderstorm',
        40: 'wi-storm-showers',
        41: 'wi-snow',
        42: 'wi-snow',
        43: 'wi-snow',
        44: 'wi-cloudy',
        45: 'wi-lightning',
        46: 'wi-snow',
        47: 'wi-thunderstorm',
        3200: 'wi-cloud'
    };


    // Fix chat heights, should call for each ajax refresh of chat box
    var forEach = Function.prototype.call.bind( Array.prototype.forEach );
    forEach($('#chat_container .chat_box ul li div:first-child'), function(elm) {
        var $iconElm = $(elm).parent().find('div:nth-child(2)');
        $(elm).height($(elm).parent().find('div:nth-child(2)').outerHeight() - 5);
    });

    // Init the geo locations
    if (!("geolocation" in navigator)) {
        $('.use_your_location_link').show();
        loadWeather('New York City',245911,false);
    } else {
        $('.use_your_location_link').hide();
        navigator.geolocation.getCurrentPosition(function(position) {
            loadWeather(position.coords.latitude+','+position.coords.longitude,null,true); //load weather using your lat/lng coordinates
        });
    }

    $('.use_your_location_link').on('click', function() {
        navigator.geolocation.getCurrentPosition(function(position) {
            loadWeather(position.coords.latitude+','+position.coords.longitude,null,true); //load weather using your lat/lng coordinates
        });
    });
    // End initing geo locations

    // Load and parse geo locations
    function loadWeather(location,woeid, updateLocationText) {
        var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

        $.simpleWeather({
            location: location,
            woeid: woeid,
            unit: 'c',
            success: function(weather) {

                var $container = angular.element('#weather_container');
                var $locationMsg =  $container.find('.weather_location');
                var $locationLink = $locationMsg.find('a');
                var $weatherIcon = $container.find('i');
                var $weatherNumber = $container.find('.weather_number');
                var $weatherUnit = $container.find('.weather_unit');
                var $weatherDesc = $container.find('.weather_desc');

                console.log(weather);


                $weatherNumber.text(weather.temp);
                $weatherUnit.text(weather.units.temp.toUpperCase());
                $weatherDesc.text(weather.currently);

                if (updateLocationText)
                    $locationMsg.html("<span class='weather_city_preview'>" + weather.city + ', ' + days[ (new Date()).getDay() ] + "</span>");

                if (codes_to_wi_icon.hasOwnProperty(weather.code))
                    $weatherIcon.addClass(codes_to_wi_icon[weather.code]);
                else
                    $weatherIcon.addClass('wi-cloud');

            },
            error: function(error) {
                angular.element("#weather_container").html('<p>'+error+'</p>');
            }
        });
    }



    $http.post('/ajax/submit_message', {msg:'hello word!'}).
        success(function(data, status, headers, config) {
            // this callback will be called asynchronously
            // when the response is available
        }).
        error(function(data, status, headers, config) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
        });
});
