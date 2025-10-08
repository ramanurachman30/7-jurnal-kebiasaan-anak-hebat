"use strict";

let view_home = {
	namespace: 'home',
	beforeEnter: data => {
		var slider = tns({
			"container": ".my-slider",
			"items": 1,
			"mouseDrag": true,
			"speed": 500,
			"autoplay": true,
			"autoplayHoverPause": true,
			"autoplayTimeout": 5000,
			"swipeAngle": false,
			"loop": true,
		});
		var slider2 = tns({
			"container": ".content-promosi",
			"loop": false,
			"rewind": true,
			"mouseDrag": true,
			"swipeAngle": false,
			"speed": 400,
			"controlsText": ["",""],
			"responsive": {
				"350": {
					"items": 1,
					"edgePadding": 32
				},
				"500": {
					"items": 4,
					"edgePadding": 30
				}
			}
		});
		var slider3 = tns({
			"container": ".content-pengumuman",
			"items": 5,
			"loop": false,
			"rewind": true,
			"mouseDrag": true,
			"swipeAngle": false,
			"speed": 400,
			"controlsText": ["",""],
			"responsive": {
				"350": {
					"items": 1,
					"edgePadding": 32
				},
				"500": {
					"items": 4,
					"edgePadding": 30
				}
			}
		});

		const title = document.querySelector('.tns-slide-active .title-slider').innerHTML;
		document.querySelector('.tns-nav-active').innerHTML = title
		slider.events.on('indexChanged', (info) => {
			const changeTitle = document.querySelector('.tns-slide-active .title-slider').innerHTML;
			const buttons = document.querySelectorAll('.tns-nav button')
			buttons.forEach((button) => {
				button.innerHTML = ''
			})
			const active = document.querySelector('.tns-nav-active')
			active.innerHTML = changeTitle
		});
		slider2.events.on('indexChanged', (info) => {
			const changeTitle = document.querySelector('.tns-slide-active .title-slider').innerHTML;
			const buttons = document.querySelectorAll('.tns-nav button')
			buttons.forEach((button) => {
				button.innerHTML = ''
			})
			const active = document.querySelector('.tns-nav-active')
			active.innerHTML = changeTitle
		});
		slider3.events.on('indexChanged', (info) => {
			const changeTitle = document.querySelector('.tns-slide-active .title-slider').innerHTML;
			const buttons = document.querySelectorAll('.tns-nav button')
			buttons.forEach((button) => {
				button.innerHTML = ''
			})
			const active = document.querySelector('.tns-nav-active')
			active.innerHTML = changeTitle
		});
	},
	enter: () => {
		// console.log("Home enter", data);
	},
	afterEnter: () => {
		$('.close-banner').on('click', function() {
			$(".floating-banner").css("display", "none");
		});
	}
}

export default view_home;