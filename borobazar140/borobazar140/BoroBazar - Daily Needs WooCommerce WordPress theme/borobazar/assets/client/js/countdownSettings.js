let date = new Date(countDownData.date);
let year = date.getFullYear();
let month = date.getMonth();
let day = date.getDate();

let countdownDiv = document.querySelector("#borobazar-countdown");
simplyCountdown(countdownDiv, {
  year,
  month: month + 1,
  day,

  words: {
    days: { singular: "D", plural: "D" },
    hours: { singular: "H", plural: "H" },
    minutes: { singular: "M", plural: "M" },
    seconds: { singular: "S", plural: "S" },
  },
});
