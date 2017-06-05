window.console = window.console || function(t) {};

$('#login-button').click(function () {
    $('#login-button').fadeOut('slow', function () {
        $('#container').fadeIn();
        TweenMax.from('#container', 0.4, {
            scale: 0,
            ease: Sine.easeInOut
        });
        TweenMax.to('#container', 0.4, {
            scale: 1,
            ease: Sine.easeInOut
        });
    });
});
$('.close-btn').click(function () {
    TweenMax.from('#container', 0.4, {
        scale: 1,
        ease: Sine.easeInOut
    });
    TweenMax.to('#container', 0.4, {
        left: '0px',
        scale: 0,
        ease: Sine.easeInOut
    });
    $('#container, #forgotten-container').fadeOut(800, function () {
        $('#login-button').fadeIn(800);
    });
});
$('#forgotten').click(function () {
    $('#container').fadeOut(function () {
        $('#forgotten-container').fadeIn();
    });
});

if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");