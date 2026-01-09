<?php
require __DIR__ . '/../config/dbconnect.php';

$sql = "
SELECT 
    oi.id AS order_item_id,
    o.id AS order_id,
    p.name AS product,
    oi.quantity
FROM order_items oi
JOIN orders o ON oi.order_id = o.id
JOIN products p ON oi.product_id = p.id
WHERE oi.picked = 0
ORDER BY o.id
";

$stmt = $conn->query($sql);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Magazijn overzicht</h2>

<table border="1">
<tr>
    <th>Order</th>
    <th>Product</th>
    <th>Aantal</th>
    <th>Status</th>
</tr>

<?php foreach ($items as $item): ?>
<tr>
    <td>#<?= $item['order_id'] ?></td>
    <td><?= $item['product'] ?></td>
    <td><?= $item['quantity'] ?></td>
    <td>
        <form method="post" action="pick_item.php">
            <input type="hidden" name="order_item_id" value="<?= $item['order_item_id'] ?>">
            <button type="submit">✔ Ingepakt</button>
        </form>
    </td>
</tr>
<?php endforeach; ?>
</table>
