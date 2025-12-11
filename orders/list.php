<!-- eenvoudige layout -->
<h1>Bestellingen</h1>
<table>
  <thead><tr><th>Ordernummer</th><th>Klant</th><th>Artikelen</th><th>Status</th><th>Acties</th></tr></thead>
  <tbody>
    <?php foreach($orders as $o): ?>
      <tr>
        <td><?=htmlspecialchars($o['order_number'])?></td>
        <td><?=htmlspecialchars($o['firstname'].' '.$o['lastname'])?><br>
            <?=htmlspecialchars($o['street'].' '.$o['postal'].' '.$o['city'])?></td>
        <td>
          <?php
            $stmt = \App\Models\Database::getConnection()->prepare('SELECT p.name, oi.quantity FROM order_items oi JOIN products p ON p.id = oi.product_id WHERE oi.order_id = ?');
            $stmt->execute([$o['id']]);
            foreach($stmt->fetchAll() as $it) {
              echo htmlspecialchars($it['name']).' x'.$it['quantity'].'<br>';
            }
          ?>
        </td>
        <td><?=htmlspecialchars($o['status'])?></td>
        <td><a href="/orders/edit?id=<?=$o['id']?>">Bewerken</a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
