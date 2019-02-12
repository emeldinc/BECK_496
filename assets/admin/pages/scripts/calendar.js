var Calendar = function() {


    return {
        //main function to initiate the module
        init: function() {
            Calendar.initCalendar();
              $('#calendar').fullCalendar('option', 'height', 550);
        },



        initCalendar: function() {

            if (!jQuery().fullCalendar) {
                return;
            }

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            var h = {};

            if (Metronic.isRTL()) {
                if ($('#calendar').parents(".portlet").width() <= 720) {
                    $('#calendar').addClass("mobile");
                    h = {
                        right: 'title, prev, next',
                        center: '',
                        left: 'month, today'
                    };
                } else {
                    $('#calendar').removeClass("mobile");
                    h = {
                        right: 'title',
                        center: '',
                        left: 'month, today, prev,next'
                    };
                }
            } else {
                if ($('#calendar').parents(".portlet").width() <= 720) {
                    $('#calendar').addClass("mobile");
                    h = {
                        left: 'title, prev, next',
                        center: '',
                        right: 'today,month'
                    };
                } else {
                    $('#calendar').removeClass("mobile");
                    h = {
                        left: 'title',
                        center: '',
                        right: 'prev,next,today,month'
                    };
                }
            }

            var initDrag = function(el) {
                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim(el.text()) // use the element's text as the event title
                };
                // store the Event Object in the DOM element so we can get to it later
                el.data('eventObject', eventObject);
                // make the event draggable using jQuery UI
                el.draggable({
                    zIndex: 999,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                });
            };

            var addEvent = function(title,id) {
                title = title.length === 0 ? "Başlıksız Etkinlik" : title;
                var html = $('<div class="external-event label label-default" id = "'+id+'">'+ title + '</div>');
                jQuery('#event_box').append(html);
                initDrag(html);
            };

            $('#external-events div.external-event').each(function() {
                initDrag($(this));
            });

            $('#event_add').unbind('click').click(function() {
                var title = $('#event_title').val();
                $.ajax({
                    url: "etkinlik_ekle.php?description=" + title,
                    type: 'POST',
                    success: function(result) {
                    var x = $.parseJSON(result);
                    if(x !== "etkinlik var") {
                        addEvent(title,x);
                    }
                    else {
                        alert("Aynı isimde bir etkinlik var zaten...")
                    }
                    
                    
                }});
            });

            $.ajax({ 
               method: "GET", url: "etkinlik_getir.php",
             }).done(function( data ) { 
                var result = $.parseJSON(data);
                    $.each( result, function( key, value ) {
                        addEvent(value['description'],value['id']);
                    });
            });

            

            $('#calendar').fullCalendar('destroy'); // destroy the calendar
            $('#calendar').fullCalendar({ //re-initialize the calendar
                header: h,
                defaultView: 'month', // change default view with available options from http://arshaw.com/fullcalendar/docs/views/Available_Views/ 
                slotMinutes: 15,
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                eventDrop: function(event, delta, revertFunc) {
                    var event_id = $(event).attr("id");
                    console.log(event_id);
                    var myDate = new Date(event.start._d);
                    $.ajax({
                            url: "takvimi_guncelle.php?event_id=" + event_id+"&date="+myDate.toLocaleString(),
                            type: 'POST',
                            success: function(result) {
                    }});
                    

                    
                },
                eventClick: function(event) {
                return confirm("Bu işlem etkinliği sistemden tamamen silecektir emin misiniz...");
                
                },
                drop: function(date, allDay) { // this function is called when something is dropped

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');
                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);

                    // assign it the date that was reported
                    var event_id = $(this).attr("id");
                    copiedEventObject.id = event_id;
                    copiedEventObject.url = "takvimden_sil.php?event_id="+event_id;
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;
                    copiedEventObject.className = $(this).attr("data-class");
                    var myDate = new Date(copiedEventObject.start._d);

                     $.ajax({
                            url: "takvime_ekle.php?event_id=" + event_id+"&date="+myDate.toLocaleString(),
                            type: 'POST',
                            success: function(result) {
                                var y = $.parseJSON(result);
                                if(y === "sayfayi yenile") {
                                    window.location.reload(false);
                                }
                    }});

                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        
                        var event_id = copiedEventObject.id;
                        $.ajax({
                            url: "etkinlik_sil.php?event_id=" + event_id,
                            type: 'POST',
                            success: function(result) {
                        }});
                        $(this).remove();
                    }

                   
                },

            events: {
            url: 'takvimden_getir.php',
            type: 'POST',
            dataType: 'json',

                error: function(error) {
                    alert(error);
                }
            },
            
            });

        }

    };

}();