<script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
<script>
    // var calendar = new FullCalendar.Calendar(calendarEl, {
    //     initialView: 'timeGrid',
    //     visibleRange: {
    //         start: '2024-04-17',
    //         end: '2024-04-19'
    //     }
    // });

    document.addEventListener('DOMContentLoaded', function() {
        var events = @json($cevents);
        const calendarEl = document.getElementById('calendar')
        // const calendar = new FullCalendar.Calendar(calendarEl, {
        //     initialView: 'dayGridMonth'
        // })
        // calendar.render()
        console.log(events)
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: events
        });
        calendar.render()
    })
</script>

<div id="calendar" class="h-96"></div>
