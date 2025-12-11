<?php


require 'dbconnect.php';


class OrderController {
    public function list() {
        $pdo = Database::getConnection();
        $stmt = $pdo->query('
          SELECT o.*, u.firstname, u.lastname, u.street, u.city, u.postal
          FROM orders o
          LEFT JOIN users u ON u.id = o.user_id
          ORDER BY o.created_at DESC
        ');
        $orders = $stmt->fetchAll();
        include __DIR__ . '/../Views/orders/list.php';
    }

    public function edit(int $orderId) {
        $pdo = Database::getConnection();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // voorbeeld: bewerk klantgegevens en order items
            $pdo->beginTransaction();
            $userId = $_POST['user_id'];
            $stmt = $pdo->prepare('UPDATE users SET firstname=?, lastname=?, street=?, city=?, postal=? WHERE id=?');
            $stmt->execute([$_POST['firstname'], $_POST['lastname'], $_POST['street'], $_POST['city'], $_POST['postal'], $userId]);

            // update order items quantities
            foreach ($_POST['items'] as $itemId => $qty) {
                $stmt = $pdo->prepare('UPDATE order_items SET quantity = ? WHERE id = ?');
                $stmt->execute([(int)$qty, (int)$itemId]);
            }
            $pdo->commit();
            header('Location: /orders');
            exit;
        }
        // GET: show form
        $stmt = $pdo->prepare('SELECT * FROM orders WHERE id = ?');
        $stmt->execute([$orderId]);
        $order = $stmt->fetch();

        $stmt = $pdo->prepare('SELECT oi.*, p.name, p.sku FROM order_items oi JOIN products p ON p.id = oi.product_id WHERE oi.order_id = ?');
        $stmt->execute([$orderId]);
        $items = $stmt->fetchAll();

        include __DIR__ . '/../Views/orders/edit.php';
    }
}
