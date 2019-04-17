define([
    'jquery',
    'Magento_Ui/js/modal/modal',
    'jquery/ui'
], function ($, modal) {
    'use strict';

    $.widget('esgi.jobDepartmentAjax', {

        options: {
            url: false,
            departmentId: null
        },

        _create: function () {
            alert('ok !');
        }

    });

    return $.esgi.jobDepartmentAjax;
});
