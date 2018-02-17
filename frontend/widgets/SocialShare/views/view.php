<div class="social-share">
    <div id="fb-root"></div>

    <span class="social-share__title">Рассказать друзьям: </span>

    <?// VK ?>
    <!-- Put this script tag to the <head> of your page -->
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>
    <script type="text/javascript">
        VK.init({apiId: 5232832, onlyWidgets: true});
    </script>
    <!-- Put this div tag to the place, where the Like block will be -->
    <script type="text/javascript">
        VK.Widgets.Like("vk_like", {type: "button"});
    </script>
    <div id="vk_like" class="vk_like"></div>

    <?// Facebook ?>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.5";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <div class="fb-like"
         data-href="<?=\yii\helpers\Url::to('', true)?>"
         data-layout="button_count" data-action="recommend" data-show-faces="false" data-share="false"></div>

    <? // Odnoklasniki ?>
    <div id="ok_shareWidget"></div>
    <script>
        !function (d, id, did, st) {
            var js = d.createElement("script");
            js.src = "https://connect.ok.ru/connect.js";
            js.onload = js.onreadystatechange = function () {
                if (!this.readyState || this.readyState == "loaded" || this.readyState == "complete") {
                    if (!this.executed) {
                        this.executed = true;
                        setTimeout(function () {
                            OK.CONNECT.insertShareWidget(id,did,st);
                        }, 0);
                    }
                }};
            d.documentElement.appendChild(js);
        }(document,"ok_shareWidget",document.URL,"{width:190,height:30,st:'straight',sz:20,ck:2}");
    </script>


    <? // Twitter ?>
    <a href="https://twitter.com/share" class="twitter-share-button"{count} data-lang="ru">Твитнуть</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>


</div>