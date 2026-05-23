<?php

header('Content-Type: application/json');

require_once '../includes/gemllm.php';

$notes = $_POST['notes'] ?? '';

if(empty($notes)){

    echo json_encode([
        'success' => false,
        'message' => 'Notes are required'
    ]);

    exit;
}

$report = generatePsychologicalReport($notes);

echo json_encode([
    'success' => true,
    'report' => $report
]);
