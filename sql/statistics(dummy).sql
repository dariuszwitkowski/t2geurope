Select l.name as 'Nazwa loterii', SUM(l.ticket_price) as 'Przychód', (
    SELECT SUM(l2.ticket_price) from lotteries l2
    LEFT JOIN draws d2 ON d2.lottery_id = l2.id
    LEFT JOIN tickets t2 on d2.id = t2.draw_id
    WHERE MONTH(d2.draw_date) = 7
      AND YEAR(d2.draw_date) = 2021
      AND t2.bought_date <= d2.draw_date
      AND l2.id = l.id
GROUP BY d2.lottery_id
    ) as 'Realny zysk' from lotteries l
LEFT JOIN draws d ON d.lottery_id = l.id
LEFT JOIN tickets t on d.id = t.draw_id
WHERE MONTH(d.draw_date) = 7
  AND YEAR(d.draw_date) = 2021
GROUP BY d.lottery_id