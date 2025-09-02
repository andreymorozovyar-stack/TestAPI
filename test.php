<?php
/**
 * Тест Laravel API
 */

echo "=== Тест Laravel Test API ===\n\n";

// Базовый URL API
$baseUrl = 'http://localhost:8000/api';

// Функция для выполнения HTTP запросов
function makeRequest($method, $url, $data = null) {
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json'
    ]);
    
    if ($method === 'POST' || $method === 'PUT') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
    } elseif ($method === 'DELETE') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if (curl_error($ch)) {
        echo "   Ошибка cURL: " . curl_error($ch) . "\n";
        curl_close($ch);
        return false;
    }
    
    curl_close($ch);
    
    return [
        'response' => $response,
        'http_code' => $httpCode
    ];
}

// Тест 1: Получить все задачи
echo "1. Тест GET /api/tasks...\n";
$result = makeRequest('GET', $baseUrl . '/tasks');

if ($result === false) {
    echo "   ✗ Ошибка подключения к серверу\n";
    echo "   Убедитесь, что сервер запущен на http://localhost:8000\n\n";
    exit;
}

echo "   HTTP код: " . $result['http_code'] . "\n";
echo "   Ответ: " . substr($result['response'], 0, 200) . "...\n";

// Проверяем валидность JSON
$data = json_decode($result['response'], true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "   ✗ Ошибка парсинга JSON: " . json_last_error_msg() . "\n";
} else {
    echo "   ✓ JSON валиден\n";
    if (isset($data['success']) && $data['success']) {
        echo "   ✓ API работает правильно\n";
        $count = count($data['data']);
        echo "   ✓ Найдено задач: $count\n";
    } else {
        echo "   ✗ API вернул ошибку\n";
    }
}

echo "\n2. Тест POST /api/tasks...\n";
$taskData = [
    'title' => 'Laravel тест задача',
    'description' => 'Создана через Laravel API',
    'status' => 'pending'
];

$result = makeRequest('POST', $baseUrl . '/tasks', $taskData);
echo "   HTTP код: " . $result['http_code'] . "\n";
echo "   Ответ: " . substr($result['response'], 0, 200) . "...\n";

$data = json_decode($result['response'], true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "   ✗ Ошибка парсинга JSON: " . json_last_error_msg() . "\n";
} else {
    echo "   ✓ JSON валиден\n";
    if (isset($data['success']) && $data['success']) {
        echo "   ✓ Задача создана успешно\n";
        $taskId = $data['data']['id'];
        echo "   ✓ ID новой задачи: $taskId\n";
    } else {
        echo "   ✗ Ошибка создания задачи\n";
    }
}

echo "\n3. Тест GET /api/tasks/1...\n";
$result = makeRequest('GET', $baseUrl . '/tasks/1');
echo "   HTTP код: " . $result['http_code'] . "\n";
echo "   Ответ: " . substr($result['response'], 0, 200) . "...\n";

$data = json_decode($result['response'], true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "   ✗ Ошибка парсинга JSON: " . json_last_error_msg() . "\n";
} else {
    echo "   ✓ JSON валиден\n";
    if (isset($data['success']) && $data['success']) {
        echo "   ✓ Задача найдена\n";
    } else {
        echo "   ✗ Задача не найдена\n";
    }
}

echo "\n=== Тест Laravel API завершен ===\n";
