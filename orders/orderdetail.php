<?php
require __DIR__ . '/../config/dbconnect.php';

$orderId = $_GET['id'];

// klant + order
$stmt = $conn->prepare("
SELECT o.id, o.order_date, c.*
FROM orders o
JOIN customers c ON o.customer_id = c.id
WHERE o.id = ?
");
$stmt->execute([$orderId]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

// artikelen
$stmt = $conn->prepare("
SELECT p.name, p.price, oi.quantity
FROM order_items oi
JOIN products p ON oi.product_id = p.id
WHERE oi.order_id = ?
");
$stmt->execute([$orderId]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Klantgegevens</h2>
<form method="post" action="update_customer.php">
    <input type="hidden" name="customer_id" value="<?= $order['customer_id'] ?>">
    <input name="name" value="<?= $order['name'] ?>">
    <input name="email" value="<?= $order['email'] ?>">
    <textarea name="address"><?= $order['address'] ?></textarea>
    <button>Opslaan</button>
</form>

<h2>Bestelde artikelen</h2>
<table>
<?php foreach ($items as $item): ?>
<tr>
    <td><?= $item['name'] ?></td>
    <td><?= $item['quantity'] ?></td>
    <td>€<?= $item['price'] ?></td>
</tr>
<?php endforeach; ?>
</table>
