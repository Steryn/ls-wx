
var sc = sc || {};
//based url detection
// sc.baseUrl = (window.location.href.match(/^http[^#?]+\//i) || [])[0] || '';
var base = sc.baseUrl.split('/');
if(!base[4]){
    base[4] = '';
}else{
    base[4] += '/';
}
sc.assets = {
    url: base[4] + 'assets/images/',
    images: [
        'bg1.jpg',
        'bg-360.jpg',
        'bg-car.jpg',
        '2.jpg',
        '3.jpg',
        '4.jpg',
        '5.jpg',
        '6.jpg'
    ]
};