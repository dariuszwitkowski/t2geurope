SELECT
    l.name as 'Nazwa loterii',
    SUM(l.ticket_price) AS 'Przychód',
    SUM(CASE WHEN t.bought_date <= d.draw_date THEN l.ticket_price ELSE 0 END) AS 'Realny zysk'
FROM lotteries l
LEFT JOIN draws d ON d.lottery_id = l.id
LEFT JOIN tickets t on d.id = t.draw_id
WHERE MONTH(d.draw_date) = 7
  AND YEAR(d.draw_date) = 2021
GROUP BY l.id, l.name;