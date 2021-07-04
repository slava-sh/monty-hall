window.App = (function() {
    var controllers = {};
    return {
        init: function(route) {
            var controller = controllers[route];
            if (controller) {
                controller.call(this);
            }
        },

        controller: function(route, controller) {
            controllers[route] = controller;
        },
    };
})();

App.controller('games.show', function() {
    var gameForm = document.getElementById('game');
    if (gameForm) {
        var radios = gameForm.querySelectorAll('input[type="radio"]');
        for (var i = 0, radio; radio = radios[i]; ++i) {
            radio.style.display = 'none';
            if (!radio.disabled) {
                radio.addEventListener('click', function() {
                    gameForm.submit();
                });
                radio.parentNode.style.cursor = 'pointer';
            }
        }
        gameForm.querySelector('input[type="submit"]').style.display = 'none';
    }
});
