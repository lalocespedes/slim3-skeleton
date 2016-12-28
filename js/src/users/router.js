(function() {

    'use strict';

    angular.module('App')
        .config(function ($stateProvider) {

        $stateProvider
            .state('users', {
                url: '/users',
                controller: 'UsersController',
                controllerAs: 'users',
                templateUrl: 'users/views/users.html'
            });
        });
})();
