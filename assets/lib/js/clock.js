var date = Date.now(),
  second = 1000;

function pad(num) {
  return ('0' + num).slice(-2);
}

function updateClock() {
  var clockEl = document.getElementById('clock'),
    dateObj;
  date += second;
  dateObj = new Date(date);
  clockEl.innerHTML = pad(dateObj.getHours()) + ':' + pad(dateObj.getMinutes()) + ':' + pad(dateObj.getSeconds());
}

setInterval(updateClock, second);