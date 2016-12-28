(function () {

    'use strict';

    angular.module('App')
        .config(config);

    function config(
        $httpProvider
    ) {
    
        $httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    }

})(angular.module('App'));
