(function() {
'use strict';

    angular
        .module('App')
        .controller('DashboardController', DashboardController);

    DashboardController.inject = ['$log'];
    function DashboardController($log) {
        var vm = this;

        activate();

        ////////////////

        function activate() {

            $log.info('Dashboard');
         }
    }
})();
