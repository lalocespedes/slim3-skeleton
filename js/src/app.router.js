(function() {

    'use strict';

    angular.module('App')
        .config(stateConfig);

    function stateConfig(
        $stateProvider,
        $httpProvider,
        $urlRouterProvider
    ) {

        $urlRouterProvider.otherwise("/");

        $stateProvider
            .state('dashboard', {
                url: '/',
                controller: 'DashboardController',
                controllerAs: 'vm',
                templateUrl: 'dashboard/views/dashboard.html'
            });

    }

})();
