SELECT t.id from tickets t
LEFT JOIN draws d on d.id = t.draw_id
LEFT JOIN lotteries l on l.id = d.lottery_id
WHERE t.number = d.won_number
  AND l.name = 'GG World X';