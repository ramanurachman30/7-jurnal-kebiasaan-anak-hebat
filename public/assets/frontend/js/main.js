"use strict";

import { gsap, ScrollTrigger } from 'gsap/all';
import barba from '@barba/core';

// Barba.js views
import view_home from './views/home';
import view_static from './views/static';

// Barba.js transition
import transition_default from './transition/default';
import { removeClass, _q } from './helper/helper';

// Remove JS
removeClass(_q("html"), "no-js");

// Destroy prev scroll
barba.hooks.beforeEnter(() => {
    // Scroll to top
    window.scrollTo(0, 0);
    $(".close-menu").click(function(){
        $(".sub-menu").removeClass("show");
    });

    $('.btn-gpr button').click(function() {
        $('.widget-gpr').toggleClass('show');
    })

    $(".search-container form").click(function() {
        $(".search").focus();
    });
});

barba.hooks.afterEnter(data => {
    ScrollTrigger.refresh();
    gsap.matchMediaRefresh();
    
    $('.dropdown').find('a.active').removeClass('active');
    $("a.link-child").each(function () {
        var href = window.location.href.replace(/\?.*/g, "");
        if ($(this).attr('href') == href || href.indexOf($(this).attr('href') + '/') > -1) {
            $(this).closest('.dropdown').find('a.parent').addClass('active');
        }
    });

    $("a.submenu-mobile").each(function () {
        var href = window.location.href.replace(/\?.*/g, "");
        if ($(this).attr('href') == href || href.indexOf($(this).attr('href') + '/') > -1) {
            $(this).addClass('active');
            $(this).closest('.dropdown-menu').addClass('show');
        }
    });
});

// Initialized barba.js
barba.init({
    debug: false,
    logLevel: 0,
    transitions: [transition_default],
    views: [view_home, view_static]
});