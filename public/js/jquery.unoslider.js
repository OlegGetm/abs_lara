(function($) {

$.fn.unoslider = function(options) {

    var defaults = {
            mode: 'fade',               // 'fade', 'shift', default: 'fade'
            outControls: false,         // default: false
            outControlsBox: '',         // eg '#controls-wrap',  
            createNavigation: false,    // default: false
            autoLoop: true,             // default: true
            pause: 5000,
            autoStart: true,            // after click
            delay: 20000,
        },
        options = $.extend(defaults, options);

    return this.each(function () {

        var $this = $(this),
            panes = $this.find('> .pane-item'),
            countItems = panes.length,
            controls = false,
            naviItems = false,
            currentIndex = 0,
            intervalId,
            currentPane,

            paneWidth = 0,
            paneHeight = 0,

            divWrap,
            divNavi,
            divRibbon;

  
        var init = function() {

            if(options.mode == 'shift') {
                prepareShiftLayout();
            }
            if(options.createNavigation && countItems > 1) {
                createNavigation();
            }
            if(options.outControls && options.outControlsBox) {
                controls = $(options.outControlsBox + ' > li');
                clickControlHandler();
            }
            if(options.autoLoop === true) {
                startLoop();
            }
        }

        var next = function() {
            currentIndex += 1;
            currentIndex = (currentIndex < countItems ) ? currentIndex : 0;
            currentPane = panes.eq(currentIndex);

            if(options.outControls === true) {
                changeControlElement();
            }
            if(options.createNavigation === true) {
                changeNaviElement();
            }
            goToNextPane();
        }

        var goToNextPane = function() {
            if(options.mode == 'fade') {
                fadeTransition();
            }  else if(options.mode == 'shift') {
                shiftTransition();
            }
        }

        var changeControlElement = function() {
            controls.removeClass('active');
            controls.eq(currentIndex).addClass('active');
        }
        var changeNaviElement = function() {
            naviItems.removeClass('active');
            naviItems.eq(currentIndex).addClass('active');
        }
        
        var pause = function() {
            clearInterval(intervalId);
            if(options.autoStart) {
                setTimeout(function() {
                    startLoop();
                }, options.delay);
            }
        }

        var clickControlHandler = function() {
            controls.find('a').on('click', function(event) {
                event.preventDefault();
                currentIndex = $(this).closest('li').index();
                changeControlElement(currentIndex);
                goToNextPane();
                pause();
            });
        }

        var fadeTransition = function() {
            currentPane = panes.eq(currentIndex);
            panes.animate({opacity: 0}, 300);

            setTimeout(function() {
                panes.hide();
                currentPane.show().animate({opacity: 1}, 600);
            }, 300); 
        }

        var shiftTransition = function() {
            if(currentIndex == 0) {
                divRibbon.animate({left: '0px'}, 300);
                return;
            }
            divRibbon.animate({left: - paneWidth * currentIndex}, 300);
        }

        var prepareShiftLayout = function() {
            
            calculateSizes();

            $this.css({
                    position: 'relative',
                    'list-style': 'none',
                    'z-index': 2,
                    width: paneWidth + 'px',
                    height: paneHeight + 'px',
                    overflow: 'hidden',
                });

            divRibbon = $('<div />')
                .addClass('uno-ribbon')
                .css({
                    position: 'absolute',
                    top: '0px',
                    left: '0px',
                    'z-index': 1,
                    width: paneWidth * countItems + 'px',
                    height: paneHeight + 'px',
                    // overflow: 'hidden',
                });
            divRibbon.appendTo($this);

            $.each(panes, function(i){
                $(this).css({
                        display: 'block', 
                        float: 'left',
                        width: paneWidth + 'px',
                        height: paneHeight + 'px',
                        opacity: '1'
                })
                .appendTo(divRibbon);
            });
            panes.first().clone().appendTo(divRibbon);
        }   
        // end prepareShiftLayout

        var createNavigation = function() {
            divNavi = $('<ul>')
                .addClass('uno-navi')
                .css({position: 'absolute', 'z-index': 2});
            divNavi.appendTo($this);

            for(var i = 0; i < countItems; i++) {
                $('<li>').append($('<a>').attr('href', '#item')).appendTo(divNavi);
            }   

            naviItems = divNavi.find('li');
            naviItems.first().addClass('active');

            divNavi.find('a').on('click', function(event) {
                event.preventDefault();
                currentIndex = $(this).closest('li').index();
                changeNaviElement();
                goToNextPane();
                pause();
            });
        }   

        var calculateSizes = function() {
            panes.first().clone().css({display: 'block', opacity: '1'});
            paneWidth = panes.first().width();
            paneHeight = panes.first().height();
        }

        var startLoop = function() {
            clearInterval(intervalId);
            intervalId = setInterval(function() {
                next();
            }, options.pause);
        }

        init();

    });

  } 
})(jQuery);