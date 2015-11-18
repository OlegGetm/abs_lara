$(document).ready(function() {

    
    var resizeSlider = function () {
        if($(window).width() < 768) {
            var ratio = 2.18,
                sliderWidth = $(window).width(),
                sliderHeight = Math.ceil(sliderWidth / ratio);
            $('#slide-rotator li.pane-item, #slide-rotator .imagine').width(sliderWidth).height(sliderHeight);   
        }
    };

    resizeSlider();
    $(window).resize(function () {
        resizeSlider();
    });


    $('#slide-rotator').unoslider( {mode: 'shift', createNavigation: true});   
    $('.news-rotator').unoslider( {mode: 'shift'});   
    

    $('.event-disabled').click( function() { 
        var $this = $(this);

        $this.prop('disabled', true).css('cursor', 'none');
        if ($this.hasClass('event-then-activated')) {
            setTimeout(function () {
                $this.prop('disabled', false).css('cursor', 'pointer');
            }, 4000); 
        }
    });


    function togglePollGraph($btnToggle) {
        $('#poll_graph').toggle();
        $btnToggle.toggleClass('active');  
        var msg = $btnToggle.hasClass('active') ? 'Скрыть результаты' : 'Показать результаты';
        $btnToggle.text(msg);
    }  
 
    $('#toggle_poll_graph').click(function(event) {
        event.preventDefault();
        togglePollGraph($(this));
    });    


    $('#vote_submit').click(function(event) {
        event.preventDefault();
        if (!$(".poll_result input[name='id']:checked").val()) {
            var messageEl = $('#poll-message');
            messageEl.text('Выберите вариант ответа:');
            setTimeout(function() { messageEl.text(''); }, 4000);
            return false;
        }

        var form = $(this).closest('form');
        $.ajax({
            url: form.attr("action"),
            dataType: "json",
            type: "POST",
            data: form.serialize(),
            
            success: function(data){
                if(data.id) {
                    $('#poll_graph #vote_' + data.id).text(data.vote);
                    togglePollGraph($('#toggle_poll_graph'));
                }
            }
        });
    });                   


    $('article.article p').each(function() {
        if(!$(this).has('<strong>') && $(this).text().length < 70) {
            $(this).css({'line-height': '1.0em', 'padding-top': '4px'});
        }
    });


    $('.video-wrap iframe').each(function() {
        var width = $(this).parents('article.article').width(),
            height = Math.round(width / $(this).attr('width') * $(this).attr('height'));
        $(this).attr({'width': width, 'height': height});
    }); 





});
    
