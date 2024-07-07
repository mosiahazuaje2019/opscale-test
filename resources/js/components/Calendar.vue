<template>
    <div id="calendar"></div>
  </template>
  
  <script>
  import { Calendar } from '@fullcalendar/core';
  import dayGridPlugin from '@fullcalendar/daygrid';
  
  export default {
    mounted() {
      let calendarEl = document.getElementById('calendar');
      let calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin],
        events: this.events,
      });
      calendar.render();
    },
    data() {
      return {
        events: []
      }
    },
    created() {
      axios.get('/api/calendar-events')
        .then(response => {
          this.events = response.data;
        });
    }
  }
  </script>
  