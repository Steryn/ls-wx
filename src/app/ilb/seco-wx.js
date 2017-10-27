
(function () {
    'use strict';

    var app = angular.module('app')
        // 微信分享认证
        .factory('wxGetConfig', ['$location', '$rootScope', '$http', function ($location, $rootScope, $http) {
            return {
                main: function (baseUrl) {
                    return new Promise(function (resolve) {
                        //微信初始化及自定义分享函数->
                        if (window.wx) {
                            $http.post(baseUrl + 'jssdk.php').success(function (data) {
                                wx.config({
                                    // debug: true,
                                    appId: data.appId,
                                    timestamp: data.timestamp,
                                    nonceStr: data.nonceStr,
                                    signature: data.signature,
                                    jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'addCard', 'chooseCard', 'openCard']
                                });
                                resolve();
                            }).error(function () {
                                console.warn('微信自定义分享初始化出错，调用wx.php失败！');
                            });
                        }
                    })
                }
            }
        }])
        // 微信分享接口配置
        .factory('wxConfig', ['$location', '$http', function ($location, $http) {
            return {
                main: function (wxshare) {
                    //微信分享接口->
                    if (window.wx) {
                        wx.ready(function () {
                            // alert('yes');
                            wx.onMenuShareTimeline({
                                title: wxshare.ttitle,
                                link: wxshare.link,
                                imgUrl: wxshare.imgUrl,
                                success: wxshare.tsuccess
                            });
                            wx.onMenuShareAppMessage({
                                title: wxshare.ftitle,
                                desc: wxshare.fdesc,
                                link: wxshare.link,
                                imgUrl: wxshare.imgUrl,
                                success: wxshare.success
                            });
                        });
                    }
                    // <-end
                }
            }

        }])
        // 获取个人信息
        .factory('wxInfo', ['$location', '$http', '$q', function ($location, $http, $q) {
            return {
                main: function (scwx) {
                    var deferred = $q.defer();
                    if (window.wx) {
                        // 微信获取个人信息start->
                        scwx.account.code = getQueryString('code');
                        if (!scwx.account.code) {
                            location.href = scwx.baseUrl + "baby.php";
                        } else {
                            $http({
                                // async : false, 
                                method: 'post',
                                url: scwx.baseUrl + "getUserInfo.php",
                                data: {
                                    id: scwx.account.appId,
                                    secret: scwx.account.appSecret,
                                    code: scwx.account.code,
                                },
                                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                                transformRequest: function (obj) {
                                    var str = [];
                                    for (var p in obj) {
                                        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                                    }
                                    return str.join("&");
                                }
                            }).success(function (result) {
                                deferred.resolve(result);
                                // console.log('subscribe:' + result.subscribe);
                                // console.log('openid:' + result.openid);
                                // console.log('nickname:' + result.nickname);
                                // console.log('sex:' + result.sex);
                                // console.log('city:' + result.city);
                                // console.log('province:' + result.province);
                                // console.log('country:' + result.country);
                                // console.log('headimgurl:' + result.headimgurl);
                            }).error(function () {
                                console.warn('微信获取个人信息初始化出错，调用失败！');
                            })
                        }
                        // <-end
                    }
                    return deferred.promise;
                }
            }

        }])
        // 扫码请求
        .factory('wxPayMent', ['$location', '$http', '$q', function ($location, $http, $q) {
            return {
                main: function (scwx) {
                    var deferred = $q.defer();
                    $http.post(scwx.baseUrl + 'example/native.php').success(function (data) {
                        // console.log("扫码支付数据" + data);
                        deferred.resolve(data);
                    }).error(function () {
                        console.warn('微信支付初始化出错，调用失败！');
                    });
                    return deferred.promise;
                }
            }

        }])
        //订单查询
        .factory('wxOrder', ['$location', '$http', '$q', function ($location, $http, $q) {
            return {
                main: function (scwx) {
                    var deferred = $q.defer();
                    if (window.wx) {
                        $http({
                            // async : false, 
                            method: 'post',
                            url: scwx.baseUrl + "example/orderquery.php",
                            data: {
                                transaction_id: scwx.order.transaction_id,
                                out_trade_no: scwx.order.out_trade_no
                            },
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            transformRequest: function (obj) {
                                var str = [];
                                for (var p in obj) {
                                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                                }
                                return str.join("&");
                            }
                        }).then(function (result) {
                            deferred.resolve(result.data);
                        }, function () {
                            console.warn('微信查询订单信息出错，调用失败！');
                        })
                    }
                    return deferred.promise;
                }
            }

        }])
        // 订单退款
        .factory('wxRefund', ['$location', '$http', '$q', function ($location, $http, $q) {
            return {
                main: function (scwx) {
                    var deferred = $q.defer();
                    if (window.wx) {
                        $http({
                            // async : false, 
                            method: 'post',
                            url: scwx.baseUrl + "example/refund.php",
                            data: {
                                transaction_id: scwx.order.transaction_id,
                                out_trade_no: scwx.order.out_trade_no,
                                total_fee: scwx.refund.total_fee,
                                refund_fee: scwx.refund.refund_fee,
                            },
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            transformRequest: function (obj) {
                                var str = [];
                                for (var p in obj) {
                                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                                }
                                return str.join("&");
                            }
                        }).then(function (result) {
                            deferred.resolve(result.data);
                        }, function () {
                            console.warn('微信退款信息出错，调用失败！');
                        })
                    }
                    return deferred.promise;
                }
            }

        }])
        // 退款查询
        .factory('wxRefundquery', ['$location', '$http', '$q', function ($location, $http, $q) {
            return {
                main: function (scwx) {
                    var deferred = $q.defer();
                    if (window.wx) {
                        $http({
                            // async : false, 
                            method: 'post',
                            url: scwx.baseUrl + "example/refundquery.php",
                            data: {
                                transaction_id: scwx.order.transaction_id,
                                out_trade_no: scwx.order.out_trade_no,
                                out_refund_no: scwx.refundquery.out_refund_no,
                                refund_id: scwx.refundquery.refund_id,
                            },
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            transformRequest: function (obj) {
                                var str = [];
                                for (var p in obj) {
                                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                                }
                                return str.join("&");
                            }
                        }).then(function (result) {
                            deferred.resolve(result.data);
                        }, function () {
                            console.warn('微信退款信息出错，调用失败！');
                        })
                    }
                    return deferred.promise;
                }
            }

        }])
        // 订单信息下载
        .factory('wxDownload', ['$location', '$http', '$q', function ($location, $http, $q) {
            return {
                main: function (scwx) {
                    var deferred = $q.defer();
                    if (window.wx) {
                        $http({
                            // async : false, 
                            method: 'post',
                            url: scwx.baseUrl + "example/download.php",
                            data: {
                                transaction_id: scwx.order.transaction_id,
                                out_trade_no: scwx.order.out_trade_no,
                                bill_date: scwx.download.bill_date,
                                bill_type: scwx.download.bill_type,
                            },
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            transformRequest: function (obj) {
                                var str = [];
                                for (var p in obj) {
                                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                                }
                                return str.join("&");
                            }
                        }).then(function (result) {
                            deferred.resolve(result.data);
                        }, function () {
                            console.warn('微信下载调用出错，调用失败！');
                        })
                    }
                    return deferred.promise;
                }
            }

        }])

})();