$(document).ready(function() 
{
    var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:
    {
        left: 'title',
        center: '',
        right: 'prev, next'
    },
    events: 'settings_trade_calendar-ajax.php?LOADDATA',
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay)
    {
        $('#addDirectEvent').modal('show');

        var start = $.fullCalendar.formatDate(start, "DD-MM-YYYY");
        $('#addDirectEvent input[name="txtEventDate"]').val(start);
        
        //var title = $("#ddlevent option:selected").val();

        // if(title != -1)
        // {
        //     var start = $.fullCalendar.formatDate(start, "YYYY-MM-DD");
        //     //var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
        //     $.ajax({
        //     url:"settings_trade_calendar-ajax.php?INSERTDATA",
        //     type:"POST",
        //     data:{title:title, start:start},
        //     success:function(responsetext)
        //     {
        //         alert(responsetext);
        //         calendar.fullCalendar('refetchEvents');
        //         alert("Added Successfully");
        //     }
        //     })
        // }
    },
    editable:true,
    eventResize:function(event)
    {
        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
        var title = event.title;
        var id = event.id;
        $.ajax({
        url:"settings_trade_calendar-ajax.php?UPDATEDATA",
        type:"POST",
        data:{title:title, start:start, end:end, id:id},
        success:function(){
        calendar.fullCalendar('refetchEvents');
        alert('Event Update');
        }
        })
    },

    eventDrop:function(event)
    {
        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
        var title = event.title;
        var id = event.id;
        $.ajax({
            url:"settings_trade_calendar-ajax.php?UPDATEDATA",
            type:"POST",
            data:{title:title, start:start, end:end, id:id},
            success:function()
            {
            calendar.fullCalendar('refetchEvents');
            alert("Event Updated");
            }
        });
    },

    eventClick:function(event)
    {
        // if(confirm("Are you sure you want to remove it?"))
        // {
        //     var id = event.id;
        //     $.ajax({
        //     url:"settings_trade_calendar-ajax.php?DELETEDATA",
        //     type:"POST",
        //     data:{id:id},
        //     success:function()
        //     {
        //         calendar.fullCalendar('refetchEvents');
        //         alert("Event Removed");
        //     }
        //     })
        // }
        showConfirmMessageDelete(event.id);
    },
    });
});

function insertCalEvent(events)
{
    var title = $("#ddlevent option:selected").val();

    var start = $('#addDirectEvent input[name="txtEventDate"]').val();

    $.ajax({
        url:"settings_trade_calendar-ajax.php?INSERTDATA",
        type:"POST",
        data:{title:title, start:start},
        success:function(response)
        {
            $('#addDirectEvent').modal('hide');
            $('#calendar').fullCalendar('refetchEvents');
            swal("Event Added Successfully!");
        }
    })
}

function showConfirmMessageDelete(id)
{
  //alert(status);
     swal({
          title: "Warning",
          text: "Do you want to delete the event?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete)
            {
                $.ajax({
                    url:"settings_trade_calendar-ajax.php?DELETEDATA",
                    type:"POST",
                    data:{id:id},
                    success:function(response)
                    {
                        swal("Event Deleted Successfully!");
                        $('#calendar').fullCalendar('refetchEvents');
                    }
              })
              swal("Confirmed! Calendar event has been deleted!",
              {
                    icon: "success",
              });
            }
            else
            {
                  swal("Delete event request cancelled!");
            }
      });
}