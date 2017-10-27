<?php
    require_once 'cardb.php';
    $wx = new WxApi();
    $signPackage = $wx->wxJsapiPackage();
    //print_r($signPackage);
    $kqInfo = $wx->wxCardPackage("***************");
    $listInfo = $wx->wxCardListPackage();
 
    //通过网页获取openid
    //if(!isset($_GET['code'])){
    //    header("location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=".WxApi::appId."&redirect_uri=http://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']."&response_type=code&scope=snsapi_base&state=1#wechat_redirect");
    //}
    //else{
    //    $CODE =  $_GET['code'];
    //    $Info = $wx->wxOauthAccessToken($CODE);
        //print_r($Info);
    //    $openId = $Info['openid'];    
    //}
    ////////////////////////////////////////////
?>
<html>
    <head>
        <title>JSAPI接口测试</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    </head>
    <body>
        <div>
            <input type="button" id="batchAddCard" name="batchAddCard" value="添加卡券" /><br />
            <input type="button" id="openCard" name="openCard" value="拉起卡券库" /><br />
            <input type="button" id="ShareTimeLine" name="ShareTimeLine" value="分享朋友圈" /><br />
            <div id="showInfo">
             
            </div>
        </div>
         
        <script>
            wx.config({
              debug: false,
              appId: '<?php echo $signPackage["appId"];?>',
              timestamp: <?php echo $signPackage["timestamp"];?>,
              nonceStr: '<?php echo $signPackage["nonceStr"];?>',
              signature: '<?php echo $signPackage["signature"];?>',
              jsApiList: [
                // 所有要调用的 API 都要加到这个列表中
                'onMenuShareTimeline',
                  'onMenuShareAppMessage',
                  'addCard',
                  'openCard'
              ]
            });
             
            wx.ready(function () {
                // 在这里调用 API
              document.querySelector('#batchAddCard').onclick = function () {
                wx.addCard({
                  cardList: [
                    {
                      cardId: '***************************',
                      cardExt: '{"timestamp":"<?php echo $kqInfo['cardExt']['timestamp'];?>", 
                      "signature":"<?php echo $kqInfo['cardExt']['signature'];?>"}'
                    }
                  ],
                  success: function (res) {
                    var cardList = res.cardList; // 添加的卡券列表信息
                    alert(cardList);
                  },
                cancel: function (res) {
                        alert('已取消');
                },
                fail: function (res) {
                        alert(JSON.stringify(res));
                }
                });
              };
               
            });
 
            var readyFunc = function onBridgeReady() {
                // 绑定关注事件
                document.querySelector('#openCard').addEventListener('click',
                    function(e) {
                        WeixinJSBridge.invoke('chooseCard', {
                            "app_id": "<?php echo $listInfo['app_id']?>",
                            "location_id ": '',
                            "sign_type": "SHA1",
                            "card_sign": "<?php echo $listInfo['card_sign']?>",
                            "card_id": "<?php echo $listInfo['card_id']?>",
                            "card_type": "<?php echo $listInfo['card_type']?>",
                            "time_stamp": "<?php echo $listInfo['time_stamp']?>",
                            "nonce_str": "<?php echo $listInfo['nonce_str']?>"
                        },
                    function(res) {
                        alert(res.err_msg + res.choose_card_info);
                        $("#showInfo").empty().append(res.err_msg + res.choose_card_info);
                    });
                });
            }
             
            if (typeof WeixinJSBridge === "undefined") {
                document.addEventListener('WeixinJSBridgeReady', readyFunc, false);
            } else {
                readyFunc();
            }
 
          </script>
    </body>
</html>