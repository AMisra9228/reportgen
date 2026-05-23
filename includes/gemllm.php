
<?php

function generatePsychologicalReport($input)
{
    $apiKey = "AIzaSyAZm1Bgy1F_DNSTFCLLmfZ6XdllNoTBjy8";

    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . $apiKey;

    $prompt = "
    Act as a professional clinical psychologist.

    Generate a structured psychological assessment report
    based on the following notes:

    $input

    Include:
    - Presenting concerns
    - Behavioral observations
    - Emotional status
    - Cognitive patterns
    - Risk indicators
    - Recommendations

    Use professional language.
    Do not hallucinate missing information.
    ";

    $data = [
        "contents" => [
            [
                "parts" => [
                    [
                        "text" => $prompt
                    ]
                ]
            ]
        ]
    ];

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json"
    ]);

    $response = curl_exec($ch);

    if(curl_errno($ch)){
        return "Curl Error: " . curl_error($ch);
    }

    curl_close($ch);

    $result = json_decode($response, true);

    return $result['candidates'][0]['content']['parts'][0]['text']
           ?? "No response generated.";
}
