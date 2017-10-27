var sc = sc || {};

function playVideoTimeEvent(target, time, func) {
    var video = $(target)[0];
    if (time == 0) {
        $(target).on('ended', function () {
            func();
        });
    } else {
        $(target).on('timeupdate', function () {
            if (video.currentTime > time) {
                func();
            }
        });
    }
};
function getQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) {
        return unescape(r[2]);
    }
    return null;
}