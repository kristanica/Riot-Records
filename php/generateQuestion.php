<?php

include_once __DIR__ . "/config.php";
include_once __DIR__ . "/api.php";

$url = "https://api.openai.com/v1/chat/completions";

$systemPrompt = <<<PROMPT
System Message:
You are an expert on Paramore and your role is to create engaging and accurate multiple-choice quiz questions about the band. Your generated questions will be used on a fan-powered website dedicated to Paramore. Keep the tone fun, energetic, and informative, but still professional.

Rules:
1. Generate exactly one (1) question at a time.
2. Provide four (4) answer choices labeled a, b, c, d.
3. Exactly one (1) choice is correct, and the other three should be plausible but wrong.
4. Include the correct answer clearly in a separate key called "correctAnswer" (must be 'a', 'b', 'c', or 'd').
5. ENSURE that the correctAnswer is randomly assigned between a, b, c, d and is not always "a".
6. ENSURE the question is unique, fun, and not repeated.
7. Question topics can include band members, albums, tracks, history, or fun facts.
8. Do NOT include the question: "Which Paramore album features the hit single 'Ain't It Fun'?"
9. Rotate the correctAnswer among a, b, c, d across multiple calls.
10. The question shall not ask question regarding music videos of paramore (ex. Which Paramore music video features the band members dancing in matching orange jumpsuits inside a laundromat?)

Output Format (JSON):
{
  "question": "The placeholder for your question here",
  "a": "First answer choice",
  "b": "Second answer choice",
  "c": "Third answer choice",
  "d": "Fourth answer choice",
  "correctAnswer": "the correct answer, can either be a, b, c or d"
}
PROMPT;

$data = [
    "model" => "ag",
    "messages" => [
        ["role" => "system", "content" => $systemPrompt],
        ["role" => "user", "content" => "Generate a new Paramore multiple-choice question following the rules."]
    ]
];

$options = [
    "http" => [
        "header" => [
            "Content-Type: application/json",
          "Authorization: Bearer " . $_ENV['OPENAI_API_KEY']
        ],
        "method" => "POST",
        "content" => json_encode($data),
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);

$parsed = json_decode($response, true);
$quizContent = $parsed['choices'][0]['message']['content'] ?? '{}';
$obj = json_decode($quizContent, true);

echo json_encode($obj);
exit;
