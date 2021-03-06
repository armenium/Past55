"use strict";
$(document).ready(function(){
	$("body").on("click", "[data-rmd-action]", function(e){
		e.preventDefault();
		var action = $(this).data("rmd-action");
		$(this);
		switch(action){
			case"block-open":
				var rmdTarget = $(this).data("rmd-target"),
					rmdBackdrop = $(this).data("rmd-backdrop-class") || "";
				$(rmdTarget).addClass("toggled"),
					$("body").addClass("block-opened").append('<div data-rmd-action="block-close" data-rmd-target=' + rmdTarget + ' class="rmd-backdrop rmd-backdrop--dark ' + rmdBackdrop + '" />'),
					$(".rmd-backdrop").fadeIn(300);
				break;
			case"block-close":
				var rmdTarget = $(this).data("rmd-target");
				$(rmdTarget).removeClass("toggled"),
					$("body").removeClass("block-opened"),
					$(".rmd-backdrop").fadeOut(300), setTimeout(function(){
					$(".rmd-backdrop").remove()
				}, 300);
				break;
			case"navigation-close":
				$(".navigation").removeClass("toggled"), $("body").removeClass("block-opened"), $(".rmd-backdrop").fadeOut(300), setTimeout(function(){
					$(".rmd-backdrop").remove()
				}, 300);
			case"advanced-search-open":
				$(this).closest(".search__body").addClass("toggled"), $(".h-backdrop")[0] || $("#header").append('<div data-rmd-action="advanced-search-close" class="rmd-backdrop search-backdrop" />');
				break;
			case"advanced-search-close":
				var ascParent = $(".search__body");
				$(".search-backdrop").remove(), ascParent.addClass("closed"), setTimeout(function(){
					ascParent.removeClass("toggled closed")
				}, 270);
				break;
			case"print":
				window.print();
				break;
			case"inner-search-open":
				$("body").addClass("block-opened").append('<div data-rmd-action="inner-search-close" class="rmd-backdrop--dark rmd-backdrop" />'), $("#inner-search").addClass("toggled"), $(".rmd-backdrop").fadeIn(300);
				break;
			case"inner-search-close":
				$(".rmd-backdrop").fadeOut(300), $("body").removeClass("block-opened"), $("#inner-search").removeClass("toggled"), setTimeout(function(){
					$(".rmd-backdrop").remove()
				}, 300);
				break;
			case"switch-login":
				$(this).parent().find(".tab-pane").removeClass("active in"), $("#top-nav-login").addClass("active in");
				break;
			case"scroll-to":
				var scrollToTarget = $(this).data("rmd-target"), scrollToOffset = $(this).data("rmd-offset") || 0;
				$("html, body").animate({scrollTop: $(scrollToTarget).offset().top - scrollToOffset}, 500);
				break;
			case"blog-comment-open":
				var bcoParent = $(this).closest(".list-group__text"), bcoContent = '<form class="blog-comment__reply animated fadeIn"><textarea placeholder="Write something..." class="textarea-autoheight"></textarea><div class="text-center"><button class="btn btn-xs btn-link" data-rmd-action="blog-comment-close">Post reply</button><button class="btn btn-xs btn-link" data-rmd-action="blog-comment-close">Dismiss</button></div></form>';
				bcoParent.append(bcoContent), autosize($(".textarea-autoheight"));
				break;
			case"blog-comment-close":
				var bccTarget = $(this).closest(".list-group__text").find(".blog-comment__reply");
				bccTarget.addClass("fadeOut"), setTimeout(function(){
					bccTarget.remove()
				}, 320)
		}
	});

	function isMobile(){
		return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ? !0 : void 0
	}

	if(isMobile() && $("html").addClass("ismobile"), $('[data-toggle="tooltip"]')[0] && $('[data-toggle="tooltip"]').tooltip(), $(".search__type")[0] && $('.search__type input[type="radio"]').on("change", function(){
		var value = $(this).val(),
			parent = $(this).closest(".search__type");

		parent.find("a[data-toggle]").text(value), parent.removeClass("open")
	}), $("select.select2")[0] && $("select.select2").select2({dropdownAutoWidth: !0, width: "100%"}), $(".header__recommended")[0] && $(".header__recommended .listings-grid").slick({speed: 300, slidesToShow: 4, slidesToScroll: 1, dotsClass: "slick-dots slick-dots-light", infinite: !0, responsive: [{breakpoint: 1200, settings: {slidesToShow: 3, slidesToScroll: 3}}, {breakpoint: 960, settings: {slidesToShow: 2, slidesToScroll: 2}}, {breakpoint: 700, settings: {slidesToShow: 2, slidesToScroll: 2, dots: !0, arrows: !1}}, {breakpoint: 550, settings: {slidesToShow: 1, slidesToScroll: 1, dots: !0, arrows: !1}}]}), $(".grid-widget--listings")[0] && $(".grid-widget--listings").slick({slidesToShow: 1, slidesToScroll: 1, mobileFirst: !0, dots: !0, arrows: !1, dotsClass: "slick-dots slick-dots-light", responsive: [{breakpoint: 480, settings: "unslick"}]}), $("body").on("click", ".stop-propagate", function(e){
		e.stopPropagation()
	}), $("body").on("click", ".prevent-default", function(e){
		e.preventDefault()
	}), $(".form-group--float")[0] && ($(".form-group--float").each(function(){
		var p = $(this).find(".form-control").val();
		0 == !p.length && $(this).addClass("form-group--active")
	}), $("body").on("blur", ".form-group--float .form-control", function(){
		var i = $(this).val(), p = $(this).parent();
		0 == i.length ? p.removeClass("form-group--active") : p.addClass("form-group--active")
	})), $(".light-gallery")[0] && $(".light-gallery").lightGallery(), $(".textarea-autoheight")[0] && autosize($(".textarea-autoheight")), $(".rmd-rate")[0] && $(".rmd-rate").each(function(){
		var rate = $(this).data("rate-value"), readOnly = $(this).data("rate-readonly");
		$(this).rateYo({rating: rate, fullStar: !0, starWidth: "18px", ratedFill: "#fcd461", normalFill: "#eee", readOnly: readOnly || "false"})
	}), $(".rmd-share")[0] && $(".rmd-share > div").jsSocials({shares: [
		{share: "facebook", label: "", logo: "zmdi zmdi-facebook", shareIn: "blank", css: "rmds-item mdc-bg-indigo-400 animated bounceIn"},
			{share: "twitter", label: "", logo: "zmdi zmdi-twitter", shareIn: "blank", css: "rmds-item mdc-bg-cyan-500 animated bounceIn"},
			{share: "googleplus", label: "", logo: "zmdi zmdi-google", shareIn: "blank", css: "rmds-item mdc-bg-red-400 animated bounceIn"},
			{share: "linkedin", label: "", logo: "zmdi zmdi-linkedin", shareIn: "blank", css: "rmds-item mdc-bg-blue-600 animated bounceIn"}]}), $(".action-header")[0] && $("#header, .action-header").affix({offset: {top: $(".action-header").offset().top}}), $("[data-rmd-breakpoint]")[0] && $("[data-rmd-breakpoint]").each(function(){
		var breakPoint = $(this).data("rmd-breakpoint"), target = $(this), activeItem = $(this).find("ul li.active > a").text();
		target.find(".tab-nav__inner").addClass("dropdown").prepend('<a class="tab-nav__toggle" data-toggle="dropdown">' + activeItem + "</a>"), $(window).resize(function(){
			$(this).width() < breakPoint ? (target.addClass("tab-nav--mobile"), target.find("ul").addClass("dropdown-menu")) : (target.removeClass("tab-nav--mobile"), target.find(".tab-nav__inner").removeClass("dropdown"), target.find("ul").removeClass("dropdown-menu"))
		}).resize()
	}), !$("html").is(".ie9") && $(".notes__body")[0]){
		var clamp;
		$(".notes__body").each(function(index, element){
			clamp = $(this).prev().is(".notes__title") ? 4 : 6, $clamp(element, {clamp: clamp})
		})
	}
	$("html").is(".ie9") || $(".note-view__body")[0] && $(".note-view__body").trumbowyg({autogrow: !0, btns: ["btnGrp-semantic", ["formatting"], "btnGrp-justify", "btnGrp-lists", ["removeformat"]]}), isMobile() || $(".navigation__dropdown")[0] && $(".navigation__dropdown").hover(function(){
		$(this).find(".navigation__drop-menu").fadeIn(250)
	}, function(){
		$(this).find(".navigation__drop-menu").fadeOut(200)
	}), $(".ie9")[0] && $("input, textarea").placeholder();
});
