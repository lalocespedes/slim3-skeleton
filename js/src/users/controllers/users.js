(function() {
'use strict';

    angular
        .module('App')
        .controller('UsersController', UsersController);

    UsersController.inject = ['$log'];
    function UsersController($log) {
        var vm = this;
        $log.info('users main');

        activate();

        ////////////////

        function activate() { }
    }
})();
