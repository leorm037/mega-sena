<div class="table_content">
<h1>Números: <?= $qtd ?> (ano: <?= $ano ?>)</h1>
<table class="number_played">
    <tr>
        <th>Números</th>
        <th>Vezes sorteado</th>
    </tr>
    <?php foreach ($resultado as $key => $value): ?>
        <tr>
            <td class="desc"><?= $key ?></td>
            <td><?= $value ?></td>
        </tr>
    <?php endforeach; ?>
        <tr>
            <td>Total</td>
            <td><?= number_format(count($resultado), 0, ",", ".") ?></td>
        </tr>
</table>
</div>
