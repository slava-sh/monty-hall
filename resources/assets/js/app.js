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
    var form = document.querySelector('form');
    var radios = form.querySelectorAll('input[type="radio"]');
    for (var i = 0, radio; radio = radios[i]; ++i) {
        radio.style.display = 'none';
        if (!radio.disabled) {
            radio.addEventListener('click', function() {
                form.submit();
            });
            radio.parentNode.style.cursor = 'pointer';
        }
    }
    form.querySelector('button[type="submit"]').style.display = 'none';
});
