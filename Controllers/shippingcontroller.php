<?php
public function list() {
    $pdo = Database::getConnection();
    $stmt = $pdo->query("
      SELECT o.*, u.firstname, u.lastname, u.street, u.postal, u.city
      FROM orders o
      JOIN users u ON u.id = o.user_id
      WHERE NOT EXISTS (
         SELECT 1 FROM order_items oi WHERE oi.order_id = o.id AND oi.packed = 0
      ) AND o.status <> 'In bezorging'
      ORDER BY o.created_at DESC
    ");
    $orders = $stmt->fetchAll();
    include __DIR__ . '/../Views/shipping/list.php';
}

public function setInDelivery(int $orderId) {
    // genereer adreslabel (PDF) en zet status
    $pdo = Database::getConnection();
    $stmt = $pdo->prepare('SELECT o.*, u.* FROM orders o JOIN users u ON u.id = o.user_id WHERE o.id = ?');
    $stmt->execute([$orderId]);
    $order = $stmt->fetch();
    if (!$order) { http_response_code(404); exit; }

    // PDF genereren via PdfService
    $pdfContent = \App\Services\PdfService::generateLabel($order);

    // update status
    $stmt = $pdo->prepare("UPDATE orders SET status = 'In bezorging' WHERE id = ?");
    $stmt->execute([$orderId]);

    // stuur PDF naar browser als download
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="adreslabel_'.$order['order_number'].'.pdf"');
    echo $pdfContent;
    exit;
}

?>