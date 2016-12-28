(function () {

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

        $httpProvider
            .interceptors.push(['$q', '$location', '$localStorage', function ($q, $location, $localStorage) {
                return {
                    'request': function (config) {
                        config.headers = config.headers || {};
                        if ($localStorage.token) {
                            config.headers.Authorization = 'Bearer ' + $localStorage.token;
                        }
                        return config;
                    },
                    'responseError': function (response) {
                        if (response.status === 404) {
                            location.reload(true);
                        }
                        return $q.reject(response);
                    },
                    'response': function (response) {

                        return response;
                    }
                };
            }]);
    }

})();
