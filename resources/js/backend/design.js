
(function ($) {

    'use strict';

    function initMetisMenu() {
        $("#side-menu").metisMenu();
    }

    function initLeftMenuCollapse() {
        $('#vertical-menu-btn').on('click', function (event) {
            event.preventDefault();
            $('body').toggleClass('sidebar-enable');
            if ($(window).width() >= 992) {
                $('body').toggleClass('vertical-collpsed');
                initLeftMenuConfig();
            } else {
                $('body').removeClass('vertical-collpsed');
            }
        });
    }

    function initLeftMenuConfig() {
        return $.post({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: '/admin/config/sidebarStatus',
                data: { status: true },
                cache: false
            }
        )
    }

    function initActiveMenu() {
        // === following js will activate the menu in left side bar based on url ====
        $("#sidebar-menu a").each(function () {
            let pageUrl = window.location.href.split(/[?#]/)[0];
            if (this.href == pageUrl) {
                $(this).addClass("active");
                $(this).parent().addClass("mm-active"); // add active to li of the current link
                $(this).parent().parent().addClass("mm-show");
                $(this).parent().parent().prev().addClass("mm-active"); // add active class to an anchor
                $(this).parent().parent().parent().addClass("mm-active");
                $(this).parent().parent().parent().parent().addClass("mm-show"); // add active to li of the current link
                $(this).parent().parent().parent().parent().parent().addClass("mm-active");
            }
        });
    }

    function initMenuItem() {
        $(".navbar-nav a").each(function () {
            let pageUrl = window.location.href.split(/[?#]/)[0];
            if (this.href == pageUrl) { 
                $(this).addClass("active");
                $(this).parent().addClass("active");
                $(this).parent().parent().addClass("active");
                $(this).parent().parent().parent().addClass("active");
                $(this).parent().parent().parent().parent().addClass("active");
                $(this).parent().parent().parent().parent().parent().addClass("active");
            }
        });
    }

    function initFullScreen() {
        $('[data-toggle="fullscreen"]').on("click", function (e) {
            e.preventDefault();
            $('body').toggleClass('fullscreen-enable');
            if (!document.fullscreenElement && /* alternative standard method */ !document.mozFullScreenElement && !document.webkitFullscreenElement) {  // current working methods
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.mozRequestFullScreen) {
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullscreen) {
                    document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                }
            } else {
                if (document.cancelFullScreen) {
                    document.cancelFullScreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitCancelFullScreen) {
                    document.webkitCancelFullScreen();
                }
            }
        });
        document.addEventListener('fullscreenchange', exitHandler );
        document.addEventListener("webkitfullscreenchange", exitHandler);
        document.addEventListener("mozfullscreenchange", exitHandler);
        function exitHandler() {
            if (!document.webkitIsFullScreen && !document.mozFullScreen && !document.msFullscreenElement) {
                console.log('pressed');
                $('body').removeClass('fullscreen-enable');
            }
        }
    }

    function initRightSidebar() {
        // right side-bar toggle
        $('.right-bar-toggle').on('click', function (e) {
            $('body').toggleClass('right-bar-enabled');
        });

        $(document).on('click', 'body', function (e) {
            if ($(e.target).closest('.right-bar-toggle, .right-bar').length > 0) {
                return;
            }

            $('body').removeClass('right-bar-enabled');
        });
    }

    function initDropdownMenu() {
        $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
            if (!$(this).next().hasClass('show')) {
              $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
            }
            let $subMenu = $(this).next(".dropdown-menu");
            $subMenu.toggleClass('show');
    
            return false;
        });   
    }
    
    function initComponents() {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $(function () {
            $('[data-toggle="popover"]').popover()
        })
    }

    function initPreloader() {
        $(window).on('load', function() {
            $('#status').fadeOut();
            $('#preloader').delay(350).fadeOut('slow');
        });
    }

    function initSettings() {
        if (getCookie("selectedMode")) {
            let selectedMode = getCookie("selectedMode");
            if (!selectedMode) {
                setCookie('selectedMode', "light-mode-switch");
                updateThemeSetting(false, true, true);
            } else {
                $(".right-bar input:checkbox").prop('checked', false);
                $("#" + selectedMode).prop('checked', true);
                $("#" + selectedMode).trigger("change");
                if(selectedMode === "light-mode-switch") {
                    updateThemeSetting(false, true, true);
                } else if(selectedMode === "dark-mode-switch") {
                    updateThemeSetting(true, false, true);
                } else if(selectedMode === "rtl-mode-switch") {
                    updateThemeSetting(false, true, false);
                }
            }
        }

        $("#light-mode-switch, #dark-mode-switch, #rtl-mode-switch").on("change", function(e) {
            if(e.target.id === "light-mode-switch" && $(this).prop("checked")) {
                $("#dark-mode-switch").prop("checked", false);
                $("#rtl-mode-switch").prop("checked", false);
                updateThemeSetting(false, true, true);
            } else if(e.target.id === "dark-mode-switch" && $(this).prop("checked")) {
                $("#light-mode-switch").prop("checked", false);
                $("#rtl-mode-switch").prop("checked", false);
                updateThemeSetting(true, false, true);
            } else if(e.target.id === "rtl-mode-switch" && $(this).prop("checked")) {
                $("#dark-mode-switch").prop("checked", false);
                $("#light-mode-switch").prop("checked", false);
                updateThemeSetting(false, true, false);
            }
            setCookie('selectedMode', e.target.id);
        });
    }

    function setCookie(name, value) {
        let cookieDate = new Date();
        cookieDate.setTime(cookieDate.getTime() + (365*24*60*60*1000));
        let expires = "expires=" + cookieDate.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }

    function getCookie(name) {
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    function updateThemeSetting(light, dark, rtl) {
        $("#bootstrap-light").prop("disabled", light);
        $("#bootstrap-dark").prop("disabled", dark);
        $("#app-light").prop("disabled", (rtl) ? light : true);
        $("#app-dark").prop("disabled", dark);
        $("#app-rtl").prop("disabled", rtl);
    }

    function initLogoutLink() {
        $('.logout-link').on('click', function (event) {
            $('#logout-form').submit();
            event.preventDefault();
        });
    }

    function init() {
        initMetisMenu();
        initLeftMenuCollapse();
        initActiveMenu();
        initMenuItem();
        initFullScreen();
        initRightSidebar();
        initDropdownMenu();
        initComponents();
        initSettings();
        initPreloader();
        initLogoutLink();
    }

    init();

})(jQuery);