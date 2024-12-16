<?php include 'require/lids.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статуси Лідів</title>
</head>
<body>
<h1>Статуси Лідів</h1>
<!-- Форма фільтрації -->
<form method="GET" action="lids.php">
    <label for="start_date">Дата початку:</label>
    <input type="date" id="start_date" name="start_date" required>
    <label for="end_date">Дата кінця:</label>
    <input type="date" id="end_date" name="end_date" required>
    <button type="submit">Фільтрувати</button>
</form>

<!-- Таблиця -->
<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Статус</th>
        <th>FTD</th>
    </tr>
    </thead>
    <tbody>
    <!-- Дані заповнюються PHP -->
    <?php if (!empty($responseData)) : ?>
        <?php foreach ($responseData['data'] as $lead) : ?>
            <tr>
                <td><?= htmlspecialchars($lead['id']) ?></td>
                <td><?= htmlspecialchars($lead['email']) ?></td>
                <td><?= htmlspecialchars($lead['status']) ?></td>
                <td><?= htmlspecialchars($lead['ftd']) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="4">Немає даних</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</body>
</html>