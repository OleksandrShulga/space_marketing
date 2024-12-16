<?php
if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['phone']) && isset($_POST['email'])) {
    // Отримуємо дані з форми
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    // Статичні значення
    $box_id = 28;
    $offer_id = 3;
    $countryCode = 'RU';
    $language = 'ru';
    $password = 'qwerty12';

    // Отримуємо реальний IP користувача
    $ip = $_SERVER['REMOTE_ADDR'];

    // Отримуємо домен, з якого був запит
    $landingUrl = $_SERVER['HTTP_REFERER'];

    // Дані для запиту
    $data = [
        'firstName' => $firstName,
        'lastName' => $lastName,
        'phone' => $phone,
        'email' => $email,
        'countryCode' => $countryCode,
        'box_id' => $box_id,
        'offer_id' => $offer_id,
        'language' => $language,
        'password' => $password,
        'ip' => $ip,
        'landingUrl' => $landingUrl,
        "clickId" => "",
        "quizAnswers" => "",
        "custom1" => "",
        "custom2" => "",
        "custom3" => ""
    ];

    // Ініціалізація cURL
    $ch = curl_init();

    // Налаштовуємо cURL
    curl_setopt($ch, CURLOPT_URL, 'https://crm.belmar.pro/api/v1/addlead');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Перетворюємо масив у формат x-www-form-urlencoded
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded',
        'token: ba67df6a-a17c-476f-8e95-bcdb75ed3958'
    ]);

    // Виконуємо запит
    $response = curl_exec($ch);

    // Перевіряємо на помилки
    if(curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        // Обробляємо відповідь
        $responseData = json_decode($response, true);
        if ($responseData['error']) {
            echo 'Помилка: ' . $responseData['error'];
        } else {
            echo 'Отримано відповідь: ' . print_r($responseData);
        }
    }

    // Закриваємо cURL
    curl_close($ch);
} else {
    echo 'Потрібно заповнити і відправити форму';
}