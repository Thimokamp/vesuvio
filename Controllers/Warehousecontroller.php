public function list() {
    // alleen tonen van order_items waar packed = false
    $pdo = Database::getConnection();
    $stmt = $pdo->query('
      SELECT oi.*, o.order_number, p.name as product_name
      FROM order_items oi
      JOIN orders o ON o.id = oi.order_id
      JOIN products p ON p.id = oi.product_id
      WHERE oi.packed = 0
      ORDER BY o.created_at
    ');
    $items = $stmt->fetchAll();
    include __DIR__ . '/../Views/warehouse/list.php';
}

public function packItem(int $itemId) {
    $pdo = Database::getConnection();
    $pdo->beginTransaction();
    $stmt = $pdo->prepare('UPDATE order_items SET packed = 1 WHERE id = ?');
    $stmt->execute([$itemId]);
    // logPacking
    $stmt = $pdo->prepare('INSERT INTO packing_log (order_item_id, user_id) VALUES (?, ?)');
    $stmt->execute([$itemId, \App\Services\AuthService::userId()]);
    // optioneel: check of order nu compleet is
    $stmt = $pdo->prepare('SELECT order_id FROM order_items WHERE id = ?');
    $stmt->execute([$itemId]);
    $orderId = $stmt->fetchColumn();
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM order_items WHERE order_id = ? AND packed = 0');
    $stmt->execute([$orderId]);
    $remaining = (int)$stmt->fetchColumn();
    if ($remaining === 0) {
        // markeer order als klaar voor verzending of verwijder uit magazijnoverzicht
        $stmt = $pdo->prepare("UPDATE orders SET status = 'Inpakken' WHERE id = ?");
        $stmt->execute([$orderId]);
    }
    $pdo->commit();
    header('Location: /warehouse');
}
