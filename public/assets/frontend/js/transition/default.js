"use strict";

import { gsap } from 'gsap/all';
import { _q } from '../helper/helper';

import loader from '../helper/loader';

let transition_default = {
    name: 'default-transition',
    once: async function (data) {
        var done = this.async();
        var next = data.next.container;

        // Display loading
        // await loader.init(true);
        // await loader.show(next);

        // Show next view
        var tl = gsap.timeline();
        tl.to(_q(".header"), {
            y: 0,
            duration: .75,
            ease: "expo",
        }, 0);
        tl.to(_q("main"), {
            opacity: 1,
            duration: .75,
            ease: "expo",
        }, .1);
        tl.to(_q("footer"), {
            opacity: 1,
            duration: .75,
            onComplete: () => {
                loader.empty();
                done();
            }
        }, .2);
    },
    enter: async function (data) {
        var done = this.async();
        var current = data.current.container;
        var next = data.next.container;

        current.style.opacity = 1;
        next.style.opacity = 0;

        // Image loading logic
        // await loader.init(true);
        // await loader.show(next);

        // Hide current view
        gsap.to(data.current.container, {
            opacity: 0,
            duration: .75,
            ease: "expo",
            onComplete: () => {
                // Show next view
                gsap.to(next, {
                    opacity: 1,
                    duration: .75,
                    ease: "expo",
                    onComplete: () => done()
                });

            }
        });
    },
    after: () => loader.empty()
}

export default transition_default;