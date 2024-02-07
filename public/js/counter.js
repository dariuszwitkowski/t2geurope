$(document).ready(function() {
  let timeNow = new Date();
  timeNow.setHours(timeNow.getHours() + 10);
  const isoString = timeNow.toISOString();
  $("#time-picker").val(isoString.substring(0, isoString.length - 8).replace("Z", ""));

  let lotteryDate;
  function setTime() {
    const selectedDate = $('#time-picker').val();
    lotteryDate = new Date(selectedDate);
  }
  setTime();
  $('#change-date-btn').click(setTime);

  function updateCounter() {
    const diff = lotteryDate - new Date();
    const seconds = Math.floor(diff / 1000);
    const minutes = Math.floor(seconds / 60);
    const hours = Math.floor(minutes / 60);
    const days = Math.floor(hours / 24);
    const hoursLeft = hours % 24;
    const minutesLeft = minutes % 60;
    const secondsLeft = seconds % 60;
    const values = $('.counter-val');
    if(days < 1) {
      enableLessThanDayCounter()
      $(values[0]).text(hoursLeft);
      $(values[1]).text(minutesLeft);
      $(values[2]).text(secondsLeft);
    } else {
      enableMoreThanDayCounter()
      $(values[0]).text(days);
      $(values[1]).text(hoursLeft);
      $(values[2]).text(minutesLeft);
    }
  }
  function enableLessThanDayCounter() {
    const labels = $(".label");
    $(labels[0]).text('hours')
    $(labels[1]).text('minutes')
    $(labels[2]).text('seconds')
  }
  function enableMoreThanDayCounter() {
    const labels = $(".label");
    $(labels[0]).text('days')
    $(labels[1]).text('hours')
    $(labels[2]).text('minutes')
  }
  window.setInterval(updateCounter, 500)
});