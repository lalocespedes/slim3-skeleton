(function () {

    'use strict';

    angular.module('App')
        .run(run);

    function run(
        $rootScope,
        $log
    ) {

        $rootScope.$on('$viewContentLoaded',function() {
            window.scrollTo(0,0);
        });
    }

})(angular.module('App'));