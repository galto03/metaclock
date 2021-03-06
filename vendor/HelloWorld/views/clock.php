<?php include 'header.php' ?>

<!--<h1>-->
<?php
//= $this->pageTitle
?>
<!--</h1>-->


<div data-ng-controller="ClockController">

    <div id="clock_container">
        <div id="clock_preview">
            <span ng-bind="clock.hours"></span>
            <span ng-bind="clock.minutes"></span>
            <span ng-bind="clock.seconds"></span>
        </div>

        <div id="alarm_control_panel">
            <div class="set_alarm_cont">
                <i class="fa fa-bell"></i> Press to set alarm
            </div>
        </div>

        <div>

            <div id="weather_container">
                <div class="weather_overly" ng-show="pending_geo">
                    <object data="/images/weather_preloader.svg" type="image/svg+xml">
                        <img src="/images/weather_preloader.gif">
                    </object>
                    <div style="font-size: 20px;">Loading forecast</div>
                    <div style="font-style: italic">Please <span style="color:#87A93B">allow</span> liteclock to use your location</div>
                </div>
                <div class="weather_location" ng-show="!pending_geo">
                    New York City, Today.
                    <a href="#" class="use_your_location_link">
                        Use Your Location!
                    </a>
                </div>
                <i class="wi"></i>
                <div class="weather_details">
                    <div class="weather_value"><span class="weather_number"></span><span class="weather_unit"></span></div>
                    <h3 class="weather_desc"></h3>
                </div>
                <div style="clear:both"></div>

            </div>
            <div id="chat_container">
                <div style="margin-top: 66px;float:right;/* height: 300px; */">
                    <div class="chat_box">
                        <div class="chat_overly" ng-show="send_in_process">
                            <object data="/images/chat_preloader.svg" type="image/svg+xml">
                                <img src="/images/chat_preloader.gif">
                            </object>
                        </div>
                        <ul>
                            <li><div><i class="icon-emo-wink2"></i></div><div>So what's up?</div></li>
                            <li><div><i class="icon-emo-happy"></i></div><div>Good morning, that's a long ass mussage but it works, anotheasd asd adasdas dsa dsazzzzzzzsda asdr long shizzle</div></li>
                            <li><div><i class="icon-emo-thumbsup"></i></div><div>Something nicae :)</div></li>
                            <li><div><i class="icon-emo-beer"></i></div><div>asd as</div></li>
                            <li><div><i class="icon-emo-sunglasses"></i></div><div>Its a sda assd asdsds aaasddall gooooood.... ???</div></li>
                            <li><div><i class="icon-emo-sleep"></i></div><div>How do I set the time right?</div></li>
                            <li><div><i class="icon-emo-coffee"></i></div><div>Just push the button</div></li>
                            <li><div><i class="icon-emo-tongue"></i></div><div>Sure thanks</div></li>
                        </ul>
                        <div style="clear:both"></div>
                    </div>
                    <div style="width:300px; clear: both;">
                        <div class="input-group">
                            <input ng-disabled="send_in_process" type="text" ng-model="chatText" id="chat_text" maxlength="25" class="form-control" placeholder="Say something nice">
                          <span class="input-group-btn">
                            <button data-ng-disabled="chatText.length <= 0" class="btn btn-default" type="button" ng-click="pushMessageAndUpdate()" id="chat_send_btn" style="width:96px">
                                {{ !chatText.length ? 'SEND (25)' : 'SEND (' + ( ((25 - chatText.length).toString().length <= 1 ? '0' : '') +  (25 - chatText.length).toString() + ")" ) }}
                            </button>
                          </span>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>
