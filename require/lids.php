<?php
if (isset($_GET['start_date'])) {
    // Отримуємо дати з форми
    $startDate = $_GET['start_date'] ?? null;
    $endDate = $_GET['end_date'] ?? null;

// Перевіряємо коректність дат
    if (!$startDate || !$endDate) {
        die('Необхідно вказати обидві дати');
    }

// Дані для запиту до API
    $data = [
        'startDate' => $startDate,
        'endDate' => $endDate
    ];

// Ініціалізація cURL
    $ch = curl_init();

// Налаштування запиту
    curl_setopt($ch, CURLOPT_URL, 'https://crm.belmar.pro/api/v1/getstatuses');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Формат даних
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded',
        'token: ba67df6a-a17c-476f-8e95-bcdb75ed3958'
    ]);

// Виконуємо запит
    $response = curl_exec($ch);

// Перевіряємо помилки
    if (curl_errno($ch)) {
        die('Помилка запиту: ' . curl_error($ch));
    }

// Закриваємо cURL
    curl_close($ch);

// Декодуємо відповідь
    $responseData = json_decode($response, true);
}
?>