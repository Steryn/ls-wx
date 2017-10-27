(function() {
    'use strict';

    var app = angular.module('app')

    //模块初始化代码
    .run(['$location', '$rootScope', '$anchorScroll', '$http', function($location, $rootScope, $anchorScroll, $http) {
        $rootScope.$on('$routeChangeSuccess', function(event, newUrl, oldUrl) {

        });

        $rootScope.$on("$locationChangeSuccess", function(event, cur, prev) {

        });

        $rootScope.$on("$viewContentLoaded", function(event) {});

        // 微信支付部分-》
        // 组织事件冒泡
        // $(".btn").click(function () {
        //     event.stopPropagation();
        // })

        // $(".test").addClass("on");
        // $(".test ul li").click(function () {
        //     var s = $(this).attr("parameter");
        //     $(".test").removeClass("on");
        //     $("." + s).addClass("on");
        // });
        // 《-

        // 定制测试号按钮-》
        var $creatMenu = {
            "button": [{
                        "type": "click",
                        "name": "今日歌曲",
                        "key": "V1001_TODAY_MUSIC"
                    },
                    {
                        "type": "click",
                        "name": "歌手简介",
                        "key": "V1001_TODAY_SINGER"
                    },
                    {
                        "name": "菜单",
                        "sub_button": [{
                                "type": "view",
                                "name": "搜索",
                                "url": "http://www.soso.com/"
                            },
                            {
                                "type": "view",
                                "name": "视频",
                                "url": "http://v.qq.com/"
                            },
                            {
                                "type": "click",
                                "name": "赞一下我们",
                                "key": "V1001_GOOD"
                            }
                        ]
                    }
                ]
                // "button": [
                //     {
                //         "name": "扫码",
                //         "sub_button": [
                //             {
                //                 "type": "scancode_waitmsg",
                //                 "name": "扫码带提示",
                //                 "key": "rselfmenu_0_0",
                //                 "sub_button": []
                //             },
                //             {
                //                 "type": "scancode_push",
                //                 "name": "扫码推事件",
                //                 "key": "rselfmenu_0_1",
                //                 "sub_button": []
                //             }
                //         ]
                //     },
                //     {
                //         "name": "发送位置",
                //         "type": "location_select",
                //         "key": "rselfmenu_2_0"
                //     }
                // ]
        };
        $("#creatMenu").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "menu/creatMenu.php",
                data: { creatMenu: $creatMenu },
                success: function(data) {
                    console.log(data);
                }
            });
        });
        $("#queryMenu").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "menu/queryMenu.php",
                // data: { creatMenu: $creatMenu },
                success: function(data) {
                    console.log(data);
                }
            });
        });
        $("#deleteMenu").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "menu/deleteMenu.php",
                // data: { creatMenu: $creatMenu },
                success: function(data) {
                    console.log(data);
                }
            });
        });
        // 《-
        // ----------------------------------------------------------
        // 获取时间
        function getNowFormatDate() {
            var date = new Date();
            var seperator1 = "-";
            var seperator2 = ":";
            var month = date.getMonth() + 1;
            var strDate = date.getDate();
            if (month >= 1 && month <= 9) {
                month = "0" + month;
            }
            if (strDate >= 0 && strDate <= 9) {
                strDate = "0" + strDate;
            }
            var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate +
                " " + date.getHours() + seperator2 + date.getMinutes() +
                seperator2 + date.getSeconds();
            return currentdate;
        };
        var $date = getNowFormatDate();
        // var $setIndustry = {
        //     "industry_id1": "1",
        //     "industry_id2": "2"
        // };
        // 获取模板id参数
        var $addTemplate = {
            "template_id_short": "OPENTM406494620"
        };

        // $("#setIndustry").click(function () {
        //     $.ajax({
        //         method: "post",
        //         url: sc.baseUrl + "modulMessage/setIndustry.php",
        //         data: { setIndustry: $setIndustry },
        //         success: function (data) {
        //             console.log(data);
        //         }
        //     });
        // });
        $("#addTemplate").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "modulMessage/addTemplate.php",
                data: { addTemplate: $addTemplate },
                success: function(data) {
                    console.log(JSON.parse(data));
                    var result = data;
                    sc.date = JSON.parse(result);
                    console.log(sc.date.template_id);
                }
            });
        });
        //获取模板列表
        $("#getAllTemplate").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "modulMessage/getAllTemplate.php",
                // data: { getAllTemplate: $getAllTemplate },
                success: function(data) {
                    console.log(data);
                }
            });
        });
        //删除模板
        $('.eValue').blur(function() {
            if ($(this).val() != '') {
                sc.variable = $(this).val();
            }
        });
        $("#delTemplate").click(function() {
            var $delTemplate = {
                "template_id": sc.variable,
            };
            $.ajax({
                method: "post",
                url: sc.baseUrl + "modulMessage/delTemplate.php",
                data: { delTemplate: $delTemplate },
                success: function(data) {
                    console.log(data);
                }
            });
        });
        $("#send").click(function() {
            var $send = {
                "touser": "otA530uS8ohCScMts6ZSPUuPj-DE", //我
                // "touser": "otA530nwQZYtSaShVvBZjDCBxWQ8",//峰哥
                "template_id": "-LU1utyrAbW5xxSg0KjFcnp3ZsUkA9dVoieTc0omrLU",
                "url": "https://www.uc123.com/",
                "data": {
                    // 字段头
                    "first": {
                        "value": "尊敬的客户，您的照片已完成",
                        "color": "#173177"
                    },
                    // 照片数量
                    "keyword1": {
                        "value": "20",
                        "color": "#173177"
                    },
                    // 时间日期
                    "keyword2": {
                        "value": $date,
                        "color": "#173177"
                    },
                    // 字段尾
                    "remark": {
                        "value": "感谢您使用",
                        "color": "#173177"
                    }
                }
            };
            var $touser = {
                "openID": [
                    "otA530v1fkgvH6Nogh5cfdNbNlsA", //乾隆
                    "otA530hY-F-9r2-b6tic9kESI2Xs", //神
                    "otA530uS8ohCScMts6ZSPUuPj-DE", //我
                    "otA530qJ10fXxa9r_kANXnVfBR0Q" //尹波
                ]
            }
            $.ajax({
                method: "post",
                url: sc.baseUrl + "modulMessage/send.php",
                data: { send: $send, touser: $touser.openID },
                success: function(data) {
                    console.log(data);
                }
            });
        });
        // ----------------------------------------------------------
        var $source = {
            //此路径与对应请求php文件父级为同级
            image: "/image/tims.jpg",
            voice: "",
            video: "",
            thumb: "/image/tims.jpg"
        }
        $(".upload>input").click(function() {
            var $type = $(this).attr("name");
            var $data;
            switch ($type) {
                case "image":
                    $data = $source.image;
                    break;
                case "voice":
                    $data = $source.voice;
                    break;
                case "video":
                    $data = $source.video;
                    break;
                case "thumb":
                    $data = $source.thumb;
                    break;
            }
            // console.log($type,$data);
            if ($type != "back") {
                $.ajax({
                    method: "post",
                    url: sc.baseUrl + "mass/upload.php",
                    data: { data: $source.image, type: $type },
                    success: function(data) {
                        console.log(data);
                    }
                });
            }
        });

        // 上传图文消息素材【订阅号与服务号认证后均可用】
        var $uploadnews = {
            "articles": [{
                    "thumb_media_id": "dYDG1ssiV9Gz4II1u37BIcq34tRFNn_2CEMWo0m91G_0wtH6zQCZPXnydZSvJQ4P",
                    "title": "Happy Day",
                    "content": "文本内容",
                    "author": "siyu.liu",
                    "content_source_url": "www.qq.com",
                    "digest": "digest",
                    "show_cover_pic": "1"
                },
                // {
                //     "thumb_media_id": "dYDG1ssiV9Gz4II1u37BIcq34tRFNn_2CEMWo0m91G_0wtH6zQCZPXnydZSvJQ4P",
                //     "title": "Happy Day",
                //     "content": "content",
                //     "author": "b",
                //     "content_source_url": "www.qq.com",
                //     "digest": "digest",
                //     "show_cover_pic": "0"
                // }
            ]
        };
        $("#uploadnews").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "mass/uploadnews.php",
                data: { uploadnews: $uploadnews },
                success: function(data) {
                    console.log(data + "(this content)");
                }
            });
        });

        //获取素材总数
        $("#getMaterialCount").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "mass/getMaterialCount.php",
                // data: { uploadnews: $uploadnews },
                success: function(data) {
                    console.log(data + "getMaterialCount");
                }
            });
        });
        var $batchgetMaterial = {
                "type": 'image', //素材的类型，图片（image）、视频（video）、语音 （voice）、图文（news）
                "offset": 0, //从全部素材的该偏移位置开始返回，0表示从第一个素材 返回
                "count": 10 //返回素材的数量，取值在1到20之间
            }
            //获取素材列表
        $("#batchgetMaterial").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "mass/batchgetMaterial.php",
                data: { batchgetMaterial: $batchgetMaterial },
                success: function(data) {
                    console.log(data + "batchgetMaterial");
                }
            });
        });

        var $picc = {
            "filter": {
                "is_to_all": true,
                // "group_id": "2"
            },
            "mpnews": {
                "media_id": "Iu_2n_SezOXGUyf9iIUfmOleLQvd0vdeHTI9K34PsSKHNhKA8sedf4a3PpqykaAv"
            },
            "msgtype": "mpnews"
        };

        // 创建分组【订阅号与服务号认证后均可用】
        var $groupCreat = {
            "group": { "name": "g1" }
        }
        $("#groupCreat").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "mass/groupCreat.php",
                data: { groupCreat: $groupCreat },
                success: function(data) {
                    console.log(JSON.parse(data));
                }
            });
        });

        // 查询所有分组
        // var $groupGet = {
        //     "group": { "name": "g1" }
        // }
        $("#groupGet").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "mass/groupGet.php",
                // data: { groupGet: $groupGet },
                success: function(data) {
                    console.log(JSON.parse(data));
                }
            });
        });

        // 修改分组名
        var $groupUpdata = {
            "group": {
                "id": 108,
                "name": "test_modify1"
            }
        }
        $("#groupUpdata").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "mass/groupUpdata.php",
                data: { groupUpdata: $groupUpdata },
                success: function(data) {
                    console.log(JSON.parse(data));
                }
            });
        });

        // 查询用户所在分组
        var $groupGetId = {
            "openid": "otA530uS8ohCScMts6ZSPUuPj-DE"
        }
        $("#groupGetId").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "mass/groupGetId.php",
                data: { groupGetId: $groupGetId },
                success: function(data) {
                    console.log(JSON.parse(data));
                }
            });
        });

        // 移动用户分组
        var $groupMember = {
            "openid": "otA530uS8ohCScMts6ZSPUuPj-DE",
            "to_groupid": 108
        }
        $("#groupMember").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "mass/groupMember.php",
                data: { groupMember: $groupMember },
                success: function(data) {
                    console.log(JSON.parse(data));
                }
            });
        });

        // 批量移动用户分组接口
        var $groupBatchupdate = {
            "openid": [
                "otA530nwQZYtSaShVvBZjDCBxWQ8", //峰哥
                "otA530uS8ohCScMts6ZSPUuPj-DE", //我
                "otA530v1fkgvH6Nogh5cfdNbNlsA", //乾隆
                // "otA530qJ10fXxa9r_kANXnVfBR0Q",//博
            ],
            "to_groupid": 108
        }
        $("#groupBatchupdate").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "mass/groupBatchupdate.php",
                data: { groupBatchupdate: $groupBatchupdate },
                success: function(data) {
                    console.log(data);
                }
            });
        });

        // 删除分组
        $("#groupDelete").click(function() {
            var $groupDelete = {
                "group": { "id": sc.variable }
            }
            console.log($groupDelete.group.id, sc.variable);
            if ($groupDelete.group.id) {
                $.ajax({
                    method: "post",
                    url: sc.baseUrl + "mass/groupDelete.php",
                    data: { groupDelete: $groupDelete },
                    success: function(data) {
                        console.log(JSON.parse(data));
                    }
                });
            } else {
                alert('您还没输入值!');
            }
        });

        // 根据分组进行群发【订阅号与服务号认证后均可用】
        var $groupMass = {
            "filter": {
                "is_to_all": false,
                "tag_id": 108
            },
            "text": {
                "content": "CONTENT"
            },
            "msgtype": "text"
        };
        $("#groupMass").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "mass/groupMass.php",
                data: { groupMass: $groupMass },
                success: function(data) {
                    console.log(data);
                }
            });
        });

        // 根据openId进行群发【订阅号与服务号认证后均可用】
        var $massOpenId = {
            "mpnews": {
                "touser": [
                    // "otA530nwQZYtSaShVvBZjDCBxWQ8",//峰哥
                    "otA530uS8ohCScMts6ZSPUuPj-DE", //我
                    "otA530v1fkgvH6Nogh5cfdNbNlsA", //乾隆
                    // "otA530qJ10fXxa9r_kANXnVfBR0Q",//博
                ],
                "mpnews": {
                    // "media_id": "OocH-BBiCZ9LOCf14p8sw8hPf871gXZOD3jYcWzpF-1cAoSuH55UyJYf8_ubwM8T"
                    "media_id": "CkacaP-Qtoh4bXGxKprGg_QNszBt6vEiA-8ggtoNcZTYblZn--iZLexw6Cp_xGAX"
                },
                "msgtype": "mpnews"
            },
            "text": {
                "touser": [
                    "otA530nwQZYtSaShVvBZjDCBxWQ8", //峰哥
                    "otA530uS8ohCScMts6ZSPUuPj-DE", //我 
                    "otA530v1fkgvH6Nogh5cfdNbNlsA", //乾隆
                    // "otA530qJ10fXxa9r_kANXnVfBR0Q",//博
                ],
                "text": { "content": "https://lab.secoinfo.net/discovery/dist/" },
                "msgtype": "text"
            },
            "voice": {
                "touser": [
                    "otA530nwQZYtSaShVvBZjDCBxWQ8", //峰哥
                    "otA530uS8ohCScMts6ZSPUuPj-DE", //我 
                    "otA530v1fkgvH6Nogh5cfdNbNlsA", //乾隆
                    // "otA530qJ10fXxa9r_kANXnVfBR0Q",//博
                ],
                "voice": {
                    "media_id": ""
                },
                "msgtype": "voice"
            },
            "image": {
                "touser": [
                    "otA530nwQZYtSaShVvBZjDCBxWQ8", //峰哥
                    "otA530uS8ohCScMts6ZSPUuPj-DE", //我
                    "otA530v1fkgvH6Nogh5cfdNbNlsA", //乾隆
                    // "otA530qJ10fXxa9r_kANXnVfBR0Q",//博  
                ],
                "image": {
                    "media_id": "NGsGkRKAPh3i0aKA4wugS3F4wqsk4hpRyPuLaE73cTQ2qGvcyU-fHS5xwULz3Tqd"
                        // "media_id": "8FdL58mjob1XXMPY1wMpTTSJQe7YqfJOqniT7p7xQZSQFhtosxm761gYzain1psX",
                },
                "msgtype": "image"
            },
            "video": {
                "touser": [
                    "otA530nwQZYtSaShVvBZjDCBxWQ8", //峰哥
                    "otA530uS8ohCScMts6ZSPUuPj-DE", //我 
                    "otA530v1fkgvH6Nogh5cfdNbNlsA", //乾隆
                    // "otA530qJ10fXxa9r_kANXnVfBR0Q",//博   
                ],
                "video": {
                    "media_id": ""
                },
                "msgtype": "video"
            },
            "wxcard": {
                "touser": [
                    // "otA530nwQZYtSaShVvBZjDCBxWQ8",//峰哥
                    "otA530uS8ohCScMts6ZSPUuPj-DE", //我
                    "otA530v1fkgvH6Nogh5cfdNbNlsA", //乾隆
                    // "otA530qJ10fXxa9r_kANXnVfBR0Q",//博    
                ],
                "wxcard": {
                    "media_id": "L_CewYkA_Qu6B_APP-TueDMQb4dESpBvYsPumvaDDkgkHD0u08Aa-drdpabQczW6"
                },
                "msgtype": "wxcard"
            },
        };
        $(".GMass>input").click(function() {
            var $type = $(this).attr("name");
            var $massWithOpenId;
            switch ($type) {
                case "mpnews":
                    $massWithOpenId = $massOpenId.mpnews;
                    break;
                case "text":
                    $massWithOpenId = $massOpenId.text;
                    break;
                case "voice":
                    $massWithOpenId = $massOpenId.voice;
                    break;
                case "image":
                    $massWithOpenId = $massOpenId.image;
                    break;
                case "video":
                    $massWithOpenId = $massOpenId.video;
                    break;
                case "wxcard":
                    $massWithOpenId = $massOpenId.wxcard;
                    break;
            }
            if ($type != "back") {
                $.ajax({
                    method: "post",
                    url: sc.baseUrl + "mass/groupMassOpenId.php",
                    data: { massOpenId: $massWithOpenId },
                    success: function(data) {
                        console.log(data);
                    }
                });
            }
        });

        //删除信息【半小时内的】
        var $deleteMass = {
            // 发送出去的消息ID
            "msgid": 3147483653
        };
        $("#deleteMass").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "mass/deleteMass.php",
                data: { deleteMass: $deleteMass },
                success: function(data) {
                    console.log(data);
                }
            });
        });

        //信息预览
        var $massPreview = {
            "touser": "otA530uS8ohCScMts6ZSPUuPj-DE",
            "mpnews": {
                "media_id": "L_CewYkA_Qu6B_APP-TueDMQb4dESpBvYsPumvaDDkgkHD0u08Aa-drdpabQczW6",
            },
            "msgtype": "mpnews"
        };
        $("#massPreview").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "mass/massPreview.php",
                data: { massPreview: $massPreview },
                success: function(data) {
                    console.log(data);
                }
            });
        });

        //查询群发消息发送状态
        var $massGet = {
            "msg_id": 3147483688
        };
        $("#massGet").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "mass/massGet.php",
                data: { massGet: $massGet },
                success: function(data) {
                    console.log(data);
                }
            });
        });
        // -----------------------------------------------------
        var $kfaccountAdd = {
            "kf_account": "test1@test",
            "nickname": "客服1",
            "password": "pswmd5",
        }
        var kfaccountUpdate = {
            "kf_account": "test1@test",
            "nickname": "客服1",
            "password": "pswmd5",
        }
        var kfaccountDel = {
            "kf_account": "test1@test",
            "nickname": "客服1",
            "password": "pswmd5",
        }
        var getkfList = {

        }
        var customSend = {
            "touser": "ocwXnjqfmNTHNdYrWXHLocAj6l3o",
            "msgtype": "text",
            "text": {
                "content": "Hello World"
            }
        }
        $(".group4>input").click(function() {
            // console.log($(this).attr('name'));
            var ele = $(this).attr('name');
            if (ele != 'back') {
                $.ajax({
                    method: "post",
                    url: sc.baseUrl + "custome/" + ele + ".php",
                    data: { ele: '$' + ele },
                    success: function(data) {
                        console.log(data);
                    }
                });
            }
        });


        // -----------------------------------------------------
        var $reply = {
            "ToUserName": "otA530uS8ohCScMts6ZSPUuPj-DE",
            "FromUserName": "gh_03ea4a531565",
            "Content": "ceshi huifu xiaoxi",
        }
        $("#resText").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "message/index.php",
                data: { reply: $reply },
                success: function(data) {
                    console.log(data);
                }
            });
        });
        // -----------------------------------------------------
        // 创建卡券及对应json-》
        var $cardtest = {
            "card": {
                "card_type": "GROUPON",
                "groupon": {
                    "base_info": {
                        "logo_url": "http://mmbiz.qpic.cn/mmbiz/iaL1LJM1mF9aRKPZJkmG8xXhiaHqkKSVMMWeN3hLut7X7hicFNjakmxibMLGWpXrEXB33367o7zHN0CwngnQY7zb7g/0",
                        "code_type": "CODE_TYPE_TEXT",
                        "brand_name": "微信餐厅",
                        "title": "132元双人火锅套餐",
                        "color": "Color060",
                        "notice": "使用时向服务员出示此券",
                        "sub_title": "周末狂欢必备",
                        "service_phone": "020-88888888",
                        "description": "不可与其他优惠同享\n如需团购券发票，请在消费时向商户提出\n店内均可使用，仅限堂食",
                        "date_info": {
                            "type": "DATE_TYPE_FIX_TIME_RANGE",
                            "begin_timestamp": Date.parse(new Date()) / 1000,
                            "end_timestamp": Date.parse(new Date()) / 1000 + 10000
                        },
                        "sku": {
                            "quantity": 5
                        },
                        "use_limit": 10,
                        "get_limit": 3,
                        // "use_custom_code": false,
                        // "bind_openid": false,
                        // "can_share": true,
                        // "can_give_friend": true,
                        "location_id_list": [123, 12321, 345345],
                        "center_title": "顶部居中按钮",
                        "center_sub_title": "按钮下方的wording",
                        "center_url": "www.qq.com",
                        "custom_url_name": "立即使用",
                        "custom_url": "http://www.qq.com",
                        "custom_url_sub_title": "6个汉字tips",
                        "promotion_url_name": "更多优惠",
                        "promotion_url": "http://www.qq.com",
                        "source": "大众点评"
                    },
                    "advanced_info": {
                        "use_condition": {
                            "accept_category": "鞋类",
                            "reject_category": "阿迪达斯",
                            // "can_use_with_other_discount": true
                        },
                        "abstract": {
                            "abstract": "微信餐厅推出多种新季菜品，期待您的光临",
                            "icon_url_list": [
                                "http://mmbiz.qpic.cn/mmbiz/p98FjXy8LacgHxp3sJ3vn97bGLz0ib0Sfz1bjiaoOYA027iasqSG0sj  piby4vce3AtaPu6cIhBHkt6IjlkY9YnDsfw/0"
                            ]
                        },
                        "text_image_list": [{
                                "image_url": "http://mmbiz.qpic.cn/mmbiz/p98FjXy8LacgHxp3sJ3vn97bGLz0ib0Sfz1bjiaoOYA027iasqSG0sjpiby4vce3AtaPu6cIhBHkt6IjlkY9YnDsfw/0",
                                "text": "此菜品精选食材，以独特的烹饪方法，最大程度地刺激食 客的味蕾"
                            },
                            {
                                "image_url": "http://mmbiz.qpic.cn/mmbiz/p98FjXy8LacgHxp3sJ3vn97bGLz0ib0Sfz1bjiaoOYA027iasqSG0sj piby4vce3AtaPu6cIhBHkt6IjlkY9YnDsfw/0",
                                "text": "此菜品迎合大众口味，老少皆宜，营养均衡"
                            }
                        ],
                        "time_limit": [{
                                "type": "MONDAY",
                                "begin_hour": 0,
                                "end_hour": 10,
                                "begin_minute": 10,
                                "end_minute": 59
                            },
                            {
                                "type": "HOLIDAY"
                            }
                        ],
                        "business_service": [
                            "BIZ_SERVICE_FREE_WIFI",
                            "BIZ_SERVICE_WITH_PET",
                            "BIZ_SERVICE_FREE_PARK",
                            "BIZ_SERVICE_DELIVER"
                        ]
                    },
                    "deal_detail": "以下锅底2选1（有菌王锅、麻辣锅、大骨锅、番茄锅、清补 凉锅、酸菜鱼锅可选）：\n大锅1份 12元\n小锅2份 16元 "
                }
            }
        };
        var $cardId = {
            "card": {
                "card_type": "GROUPON",
                "groupon": {
                    "base_info": {
                        "logo_url": "http://mmbiz.qpic.cn/mmbiz/iaL1LJM1mF9aRKPZJkmG8xXhiaHqkKSVMMWeN3hLut7X7hicFNjakmxibMLGWpXrEXB33367o7zHN0CwngnQY7zb7g/0",
                        "code_type": "CODE_TYPE_BARCODE",
                        "brand_name": "星巴克",
                        "title": "星巴克免费体验券",
                        "color": "Color100",
                        "notice": "使用时向服务员出示此券",
                        "sub_title": "周末狂欢必备",
                        "service_phone": "020-88888888",
                        // 使用须知
                        "description": "不可与其他优惠同享\n如需团购券发票，请在消费时向商户提出\n店内均可使用，仅限堂食",
                        "date_info": {
                            "type": "DATE_TYPE_FIX_TIME_RANGE",
                            "begin_timestamp": 1491559492,
                            "end_timestamp": 1491959492
                        },
                        "sku": {
                            "quantity": 5
                        },
                        "get_limit": 3,
                        // "use_custom_code": false,
                        // "bind_openid": false,
                        // "can_share": true,
                        // "can_give_friend": true,
                        "location_id_list": [123, 12321, 345345],
                        "custom_url_name": "立即使用",
                        "custom_url": "http://www.qq.com",
                        "custom_url_sub_title": "6个汉字tips",
                        "promotion_url_name": "更多优惠",
                        "promotion_url": "http://www.qq.com",
                        "source": "大众点评"
                    },
                    // 优惠说明
                    "deal_detail": "以下锅底2选1（有菌王锅、麻辣锅、大骨锅、番茄锅、清补凉锅、酸菜鱼锅可选）：\n大锅1份 12元\n小锅2份 16元 "
                }
            }
        };
        $("#batchAddCard").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "card/creatCard.php",
                data: { cardId: $cardtest },
                success: function(data) {
                    console.log(data);
                }
            });
        });
        // 《-

        // 显示对应card_id的二维码-》
        var $qr = {
            "action_name": "QR_CARD",
            "expire_seconds": 1800,
            "action_info": {
                "card": {
                    "card_id": "pcwXnjh_rR9fVSm_s4g4go43VEZM",
                }
            }
        };
        $("#openCard").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "card/showQrcode.php",
                data: { qr: $qr },
                success: function(data) {
                    console.log(data);
                    $(".QrImg").attr("src", data.show_qrcode_url);
                    $("#showInfo").addClass("on");
                }
            });
        });
        $("#showInfo").click(function() {
            $("#showInfo").removeClass("on");
        });
        // 《-

        // 显示查询导入code数目接口-》
        var $cardCode = {
            "card_id": "pcwXnjqVlyVyQ861VlAeSEatbl6Q"
        };
        $("#cardCode").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "card/cardCodeNum.php",
                data: { cardCode: $cardCode },
                success: function(data) {
                    console.log(data);
                }
            });
        });
        // 《-

        // 设置测试白名单-》
        var $whiteList = {
            "openid": [
                "ocwXnjqfmNTHNdYrWXHLocAj6l3o",
            ],
            "username": [
                "ocwXnjqfmNTHNdYrWXHLocAj6l3o",
            ]
        };
        $("#whiteList").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "card/cardWhiteList.php",
                data: { whiteList: $whiteList },
                success: function(data) {
                    console.log(data);
                }
            });
        });
        // 《-

        // 查询卡券详情-》
        var $getInfo = {
            "card_id": "pcwXnjiCrCH1Xvy8cTNUQIQNBoR8"
        };
        $("#getInfo").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "card/cardGetInfo.php",
                data: { getInfo: $getInfo },
                success: function(data) {
                    console.log(data);
                }
            });
        });
        // 《-

        // 批量查询卡券详情-》
        var $batchget = {
            // 查询起末位置、数量，0开始
            "offset": 101,
            "count": 110,
            "status_list": ["CARD_STATUS_VERIFY_OK", "CARD_STATUS_DISPATCH"]
                // “CARD_STATUS_NOT_VERIFY”,待审核；
                // “CARD_STATUS_VERIFY_FAIL”, 审核失败；
                // “CARD_STATUS_VERIFY_OK”， 通过审核；
                // “CARD_STATUS_DELETE”，卡券被商户删除；
                // “CARD_STATUS_DISPATCH”，在公众平台投放过的卡券；
        };
        $("#batchget").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "card/cardBatchget.php",
                data: { batchget: $batchget },
                success: function(data) {
                    console.log(data);
                }
            });
        });
        // 《-

        // 更改卡券信息接口-》
        var $update = {
            "card_id": "pcwXnjijEglDq-iSyhlMqI0_r0gM",
            "groupon": { //填写该cardid相应的卡券类型（小写）。
                "base_info": {
                    "color": "Color040",
                    "service_phone": "020-88888888",
                }
            }
        };
        $("#update").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "card/cardUpdata.php",
                data: { update: $update },
                success: function(data) {
                    console.log(data);
                }
            });
        });
        // 《-

        // 修改库存接口-》
        var $modifystock = {
            "card_id": "pcwXnjijEglDq-iSyhlMqI0_r0gM",
            // "increase_stock_value": 1231,
            "reduce_stock_value": 5000,
        };
        $("#modifystock").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "card/cardModifystock.php",
                data: { modifystock: $modifystock },
                success: function(data) {
                    console.log(data);
                }
            });
        });
        // 《-

        // 删除卡券接口-》
        var $cardDelete = {
            "card_id": "pcwXnjvzqrHSxJIDD4aoc6dRPp8M"
        };
        $("#cardDelete").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "card/cardDelete.php",
                data: { cardDelete: $cardDelete },
                success: function(data) {
                    console.log(data);
                }
            });
        });
        // 《-

        // 拉取卡券概况数据接口-》
        var $getcardbizuininfo = {
            "begin_date": "2017-03-25", //请开发者按示例格式填写日期，否则会报错date format error
            "end_date": "2017-04-01", //该接口只能拉取非当天的数据，不能拉取当天的卡券数据，否则报错
            "cond_source": 1 //查询时间区间需<=62天，否则报错{errcode: 61501，errmsg: "date range error"}
        };
        $("#getcardbizuininfo").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "card/getcardbizuininfo.php",
                data: { getcardbizuininfo: $getcardbizuininfo },
                success: function(data) {
                    console.log(data);
                }
            });
        });
        // 《-

        // 获取免费券数据接口-》
        var $getcardcardinfo = {
            "begin_date": "2017-03-25", //请开发者按示例格式填写日期，否则会报错date format error
            "end_date": "2017-04-01", //该接口只能拉取非当天的数据，不能拉取当天的卡券数据，否则报错
            "cond_source": 1, //查询时间区间需<=62天，否则报错{errcode: 61501，errmsg: "date range error"}
            "card_id": "pcwXnjqSp0yjZF4Z6wTccsZ9ynjg" //该接口目前仅支持拉取免费券（优惠券、团购券、折扣券、礼品券）的卡券相关数据
        };
        $("#getcardcardinfo").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "card/getcardcardinfo.php",
                data: { getcardcardinfo: $getcardcardinfo },
                success: function(data) {
                    console.log(data);
                }
            });
        });
        // 《-

        // 拉取会员卡概况数据接口-》
        var $membercardinfo = {
            "begin_date": "2017-03-25", //请开发者按示例格式填写日期，否则会报错date format error
            "end_date": "2017-04-01", //该接口只能拉取非当天的数据，不能拉取当天的卡券数据，否则报错
            "cond_source": 1, //查询时间区间需<=62天，否则报错{errcode: 61501，errmsg: "date range error"}
        };
        $("#membercardinfo").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "card/membercardinfo.php",
                data: { membercardinfo: $membercardinfo },
                success: function(data) {
                    console.log(data);
                }
            });
        });
        // 《-

        // 拉取会员卡概况数据接口-》
        var $membercarddetail = {
            "begin_date": "2017-03-25", //请开发者按示例格式填写日期，否则会报错date format error
            "end_date": "2017-04-01", //该接口只能拉取非当天的数据，不能拉取当天的卡券数据，否则报错
            "card_id": "pcwXnjqSp0yjZF4Z6wTccsZ9ynjg" //该接口目前仅支持拉取免费券（优惠券、团购券、折扣券、礼品券）的卡券相关数据
        };
        $("#membercarddetail").click(function() {
            $.ajax({
                method: "post",
                url: sc.baseUrl + "card/membercarddetail.php",
                data: { membercarddetail: $membercarddetail },
                success: function(data) {
                    console.log(data);
                }
            });
        });

    }])

    .directive('scOnAdd', ['$animate', function() {
        return {
            link: function(scope, element, attrs) {
                element.click(function() {
                    if (attrs.scOnAdd) {
                        $(attrs.scOnAdd).each(function() {
                            var self = this;
                            scope.$apply(function() {
                                $(self).addClass('on');
                            });
                        });
                    } else {
                        scope.$apply(function() {
                            element.addClass('on');
                        });
                    }
                });
            }
        }
    }])

    .directive('scOnRemove', ['$animate', function() {
        return {
            link: function(scope, element, attrs) {
                element.click(function() {
                    if (attrs.scOnRemove) {
                        $(attrs.scOnRemove).each(function() {
                            var self = this;
                            scope.$apply(function() {
                                $(self).removeClass('on');
                            });
                        });
                    } else {
                        scope.$apply(function() {
                            element.removeClass('on');
                        });
                    }
                });
            }
        }
    }])

})();