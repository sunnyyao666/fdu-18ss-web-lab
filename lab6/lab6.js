window.onload = function () {
    for (let i = 0; i < document.getElementById("thumbnails").getElementsByTagName("img").length; i++) {
        document.getElementById("thumbnails").getElementsByTagName("img")[i].onclick = function () {
            document.getElementById("featured").getElementsByTagName("img")[0].src = "images/medium/" + document.getElementById("thumbnails").getElementsByTagName("img")[i].src.substr(document.getElementById("thumbnails").getElementsByTagName("img")[i].src.length - 14);
            document.getElementById("featured").getElementsByTagName("img")[0].title = document.getElementById("thumbnails").getElementsByTagName("img")[i].title;
            document.getElementById("featured").getElementsByTagName("figcaption")[0].innerHTML = document.getElementById("featured").getElementsByTagName("img")[0].title;
        }
    }
    var num = 0, f1 = true, f2 = true;
    document.getElementById("featured").onmouseenter = function () {
        f1 = true;
        f2 = false;

        function fadein() {
            num++;
            document.getElementById("featured").getElementsByTagName("figcaption")[0].style.opacity = num / 10;
            if ((num >= 8) || (f1 === false)) clearInterval(inter);
        }

        var inter = setInterval(fadein, 125);
    };
    document.getElementById("featured").onmouseleave = function () {
        f1 = false;
        f2 = true;

        function fadeout() {
            num--;
            document.getElementById("featured").getElementsByTagName("figcaption")[0].style.opacity = num / 10;
            if ((num <= 0) || (f2 === false)) clearInterval(outer);
        }

        var outer = setInterval(fadeout, 125);
    };
};