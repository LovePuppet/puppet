/**
 *dec:rem方案必备 https://github.com/amfe/article/issues/17
 *time: 2017-01-09
 *author:smallke
 */

(function() {
    var rem2px = 10,
        d = window.document.createElement('div');
    d.style.width = '1rem';
    d.style.display = "none";
    var body = document.getElementsByTagName('html')[0];
    body.style.opacity = "0";
    var head = window.document.getElementsByTagName('head')[0];
    head.appendChild(d);
    var defaultFontSize = parseFloat(window.getComputedStyle(d, null).getPropertyValue('width'));
    setTimeout(function() {
        var fz = window.innerWidth / rem2px / (defaultFontSize / 16);
        fz = (window.innerWidth > 750) ? 60 : fz;
        document.documentElement.style.fontSize = fz + 'px';
        body.style.opacity = "1";
    }, 1);
})();

//# sourceMappingURL=flexible.js.map
