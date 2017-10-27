var sc = sc || {};
sc.isAndroid = /android/i.test(navigator.userAgent);
sc.isIos = /iPhone/i.test(navigator.userAgent);
// //based url detection
sc.baseUrl = (window.location.href.match(/^http[^#?]+\//i) || [])[0] || '';

(function () {
    'use strict';

    angular
        .module('app')
        // .config(config)
        .controller('RootContorller', RootContorller);

    function RootContorller($q, $scope, $location, wxGetConfig, wxConfig, wxInfo, wxPayMent, wxOrder, wxRefund, wxRefundquery, wxDownload) {
        console.log('this is RootContorller');
        // 微信变量配置：baseUrl：路径；wxshare：微信分享；account：微信个人信息
        var scwx = {};
        scwx.baseUrl = sc.baseUrl;

        //微信分享自定义配置start->
        scwx.wxshare = {
            ftitle: '分享给朋友',
            ttitle: '分享给朋友圈',
            fdesc: '分享给朋友描述',
            imgUrl: 'http://lab.secoinfo.net/discovery/dist/assets/images/share.jpg',
            link: 'http://lab.secoinfo.net/discovery/dist',
            tsuccess: function () {
                // alert('已分享');
            },
            success: function () {
                // alert('已分享');
            }
        };
        wxGetConfig.main(scwx.baseUrl).then(function () {
            wxConfig.main(scwx.wxshare);
        });
        // <-end

        // 微信获取个人信息配置->
        scwx.account = {
            appId: "wx5028eeb568c7544f",
            appSecret: "fb9f7edf8138dd07b54ae7e3b0a43599",
        };
        // wxInfo.main(scwx).then(function (data) {
        //     //在这里调用了请求成功的信息
        //     console.log(data);
        // });
        // <-

        //支付二维码生成->
        wxPayMent.main(scwx).then(function (data) {
            $(".native").children("img").attr("src", "https://lab.secoinfo.net/discovery/dist/example/qrcode.php?data=" + data);
        });
        // <-

        // 获取的值接口写在这里 配置对应必要参数->
        var transaction_id = $(".transaction_id").val() || "4007732001201703274854560598";
        var out_trade_no = $(".out_trade_no").val() || "131568530120170327181245";
        var total_fee = $(".total_fee").val() || "1";
        var refund_fee = $(".refund_fee").val() || "1";
        var out_refund_no = $(".out_refund_no").val() || "";
        var refund_id = $(".refund_id").val() || "";
        var bill_date = $(".bill_data").val() || "20170327";
        var bill_type = $(".bill_type").find("option:selected").attr("value") || "ALL";
        // <-

        // 订单查询->
        scwx.order = {
            transaction_id: transaction_id,
            out_trade_no: out_trade_no,
        };
        $(".orderquerybtn").click(function () {
            wxOrder.main(scwx).then(function (data) {
                console.log(data);
            })
        });
        // <-

        // 退款API->
        scwx.refund = {
            total_fee: total_fee,
            refund_fee: refund_fee,
        };
        $(".refundbtn").click(function () {
            wxRefund.main(scwx).then(function (data) {
                console.log(data);
            })
        });
        // <-

        // 退款查询API
        scwx.refundquery = {
            out_refund_no: out_refund_no,
            refund_id: refund_id,
        };
        $(".refundquerybtn").click(function () {
            wxRefundquery.main(scwx).then(function (data) {
                console.log(data);
            })
        });
        // <-

        // 下载订单API
        scwx.download = {
            bill_date: bill_date,
            bill_type: bill_type,
        };
        $(".downloadbtn").click(function () {
            wxDownload.main(scwx).then(function (data) {
                console.log(data);
            })
        })
        // <-


        //区分安卓苹果加类
        if (sc.isAndroid) {
            $('html').addClass('android');
        }
        if (sc.isIos) {
            $('html').addClass('ios');
        }

        // 网站素材数组
        var siteImages = [];
        for (var i = 0; i < sc.assets.images.length; i++) {
            var assets = "../" + sc.assets.url + sc.assets.images[i];
            siteImages.push(assets);
        }
        // console.log(siteImages);

        //创建加载
        var queue = new createjs.LoadQueue();
        queue.on("complete", function () {
            console.log("load Complete");
            if (queue.loaded) {
                // $('.part1,.v1,.part1>img').addClass('on');
                // start
                $('.fontPage').addClass('on');
                $('.picBox>img').eq(0).addClass('on');
                setTimeout(function () {
                    $('.btnBox>a').eq(0).addClass('on');
                }, 500);
                // end
                $('.loading').removeClass('on');
            }
        }, this);
        //加载进程
        queue.on("progress", function () {
            $('.loading').html("<p>加载进度：" + Math.round(queue.progress * 100) + "%</p>");
        }, this);
        //加载出错打印信息
        queue.on("error", function () {
            console.log("Load error!");
        }, this);

        queue.loadManifest(siteImages);

        //禁止向下拖动
        document.querySelector('body').addEventListener('touchmove', function (e) {
            e.preventDefault();
        })

        //视频点击事件
        // $('.v1').click(function(){
        //     initFun(1);
        //     clickFun(1);
        // });
        // $('.v2').click(function(){
        //     $(sc.part).removeClass('on');
        //     initFun(2);
        //     clickFun(2);
        // });
        // $('.v3').click(function(){
        //     $(sc.part).removeClass('on');
        //     initFun(3);
        //     clickFun(3);
        // });
        // $('.v4').click(function(){
        //     $(sc.part).removeClass('on');
        //     initFun(4);
        //     clickFun(4);
        // });
        // $('.v5').click(function(){
        //     $(sc.part).removeClass('on');
        //     initFun(5);
        //     clickFun(5);
        // });
        //重置Dom
        function initFun(e) {
            sc.i = e;
            sc.a = ".v" + [sc.i];
            sc.aNext = ".v" + [sc.i + 1];
            sc.part = ".part" + [sc.i];
            sc.partNext = ".part" + [sc.i + 1];
            sc.img = ".img" + [sc.i];
            sc.imgNext = ".img" + [sc.i + 1];
            sc.video = ".video" + [sc.i];
            sc.videoNext = ".video" + [sc.i + 1];
            sc.videoDom = "video" + [sc.i];
            console.log(sc);
        }
        //执行函数
        function clickFun(e) {
            console.log(sc.i);
            $(sc.a).removeClass('on');
            $(sc.part).children('img').removeClass('on');
            if (!sc.isAndroid) {
                $(sc.video).trigger('play');
            }
            if (sc.isAndroid) {
                setTimeout(function () {
                    $(sc.video).trigger('play');
                }, 500);
                document.getElementsByClassName(sc.videoDom)[0].addEventListener("x5videoexitfullscreen", function () {
                    $(sc.partNext).addClass('on');
                    $(sc.aNext).addClass('on');
                    $(sc.partNext).children('img').addClass('on');
                });
            };
            $(sc.video).on('ended', function () {
                console.log("video-" + sc.i + " end");
                $(sc.video).remove();
                if (!sc.isAndroid) {
                    $(sc.partNext).addClass('on');
                    $(sc.aNext).addClass('on');
                    $(sc.partNext).children('img').addClass('on');
                }
            })
        }

        // start
        $('.v1').click(function () {
            cFun(0);
            listener(22.7, 1);
            $('.fontPage').removeClass('on');
        });
        $('.v2').click(function () {
            cFun(1);
            listener(27.3, 2);
        });
        $('.v3').click(function () {
            cFun(2);
            listener(42.5, 3);
        });
        $('.v4').click(function () {
            cFun(3);
            listener(44.5, 4);
        });
        $('.v5').click(function () {
            cFun(4);
            listener(51, 5);
        });
        // 23.040,5.077,14.997,1.834,6.522 ==51.478
        function cFun(index) {
            // console.log('cFun',index,$('.btnBox').children('a').eq(0));
            $('.btnBox').children('a').eq(index).removeClass('on');
            $('.picBox').children('img').eq(index).removeClass('on');
            $('.videos').trigger('play');
            //true时，mask层可以打开
            sc.mask = true;
        }

        function listener(timer, nIndex) {
            sc.timer = timer;
            sc.nIndex = nIndex;
            // console.log('----1----'+sc.timer,sc.nIndex);
            document.getElementsByClassName('videos')[0].addEventListener('timeupdate', next, true);

            function next() {
                var currTime = document.getElementsByClassName('videos')[0].currentTime;
                // console.log(currTime,'----2----'+sc.timer,sc.nIndex);
                if (currTime >= sc.timer) {
                    // console.log(currTime,'----3----'+sc.timer,sc.nIndex);
                    $('.videos').trigger('pause');
                    sc.mask = false;
                    $('.btnBox').children('a').eq(sc.nIndex).addClass('on');
                    // $('.picBox').children('img').eq(sc.nIndex).addClass('on');
                    if (sc.nIndex == 5) {
                        $('.endBtnBox').addClass('on');
                    }
                    document.getElementsByClassName('videos')[0].removeEventListener('timeupdate', next, true);
                    console.log('clearListener');
                }
            }
            return;
        }
        document.getElementsByClassName('videos')[0].addEventListener("x5videoexitfullscreen", function () {
            // alert('exitfullscreen');
            $('.topBar').removeClass('on');
            if (sc.mask) {
                //在安卓下加on，向上平移
                $('.videos').addClass('on')
                $('.mask').addClass('on');
            }
        });
        document.getElementsByClassName('videos')[0].addEventListener("x5videoenterfullscreen", function () {
            if (sc.isAndroid) {
                $('.topBar').addClass('on');
            }
        });
        $('.mask').click(function () {
            $(this).removeClass('on');
            $('.videos').trigger('play').removeClass('on');
        })
        // end
    };

})();