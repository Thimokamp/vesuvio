<?php
require __DIR__ . '/../config/dbconnect.php';

$sql = "
SELECT 
    o.id AS order_id,
    o.order_date,
    c.name,
    c.email
FROM orders o
JOIN klanten c ON o.klant_id = c.id
ORDER BY o.order_date DESC
";

$stmt = $conn->query($sql);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Bestellingen</h2>

<table border="1">
<tr>
    <th>Order</th>
    <th>Klant</th>
    <th>Email</th>
    <th>Datum</th>
    <th>Acties</th>
</tr>

<?php foreach ($orders as $order): ?>
<tr>
    <td><?= $order['order_id'] ?></td>
    <td><?= $order['name'] ?></td>
    <td><?= $order['email'] ?></td>
    <td><?= $order['order_date'] ?></td>
    <td>
        <a href="order_detail.php?id=<?= $order['order_id'] ?>">Bekijk / bewerk</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
