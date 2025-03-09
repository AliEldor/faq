<?php
include(__DIR__ . "/../../connection/connection.php");

$questions = [
    [
        'question' => 'What is the Software Development Life Cycle (SDLC)?',
        'answer' => 'SDLC is a structured process for producing high-quality, low-cost software in the shortest possible time by defining tasks and stages systematically.'
    ],
    [
        'question' => 'Why is SDLC important?',
        'answer' => 'It provides a systematic framework to manage software development efficiently, ensuring all stakeholders agree on requirements, goals, and deliverables upfront.'
    ],
    [
        'question' => 'What are the common SDLC models?',
        'answer' => 'Common SDLC models include Waterfall, Iterative, Spiral, Agile, DevOps, V-Model, RAD, and Prototype models.'
    ],
    [
        'question' => 'What is the Waterfall model?',
        'answer' => 'A linear, sequential approach where each phase (Requirements, Design, Development, Testing, Maintenance) is completed before moving to the next.'
    ],
    [
        'question' => 'What are the advantages of the Waterfall model?',
        'answer' => 'It is simple and easy to manage, has well-defined phases with clear deliverables, and works well for projects with stable requirements.'
    ],
    [
        'question' => 'What is the Iterative model?',
        'answer' => 'A model that starts with a small set of requirements and improves the software in repeated cycles (iterations).'
    ],
    [
        'question' => 'How does the Spiral model work?',
        'answer' => 'It combines iterative development with risk analysis, focusing on building software in cycles while assessing and mitigating risks.'
    ],
    [
        'question' => 'What is the Agile model?',
        'answer' => 'Agile focuses on iterative development with frequent updates, customer collaboration, and adaptability to changes.'
    ],
    [
        'question' => 'What are some common Agile frameworks?',
        'answer' => 'Common Agile frameworks include Scrum, Kanban, Extreme Programming (XP), and Lean Software Development.'
    ],
    [
        'question' => 'What is the DevOps model?',
        'answer' => 'It integrates development and operations teams, emphasizing automation, continuous integration, and delivery.'
    ],
    [
        'question' => 'How do you choose the right SDLC model for a project?',
        'answer' => 'Consider factors like project size, requirement stability, customer involvement, risk tolerance, compliance needs, and team experience.'
    ],
    [
        'question' => 'Which SDLC model is best for large, high-risk projects?',
        'answer' => 'The Spiral model, due to its strong focus on risk management and iterative improvements.'
    ],
    [
        'question' => 'Which model is best for projects with evolving requirements?',
        'answer' => 'Agile or Iterative models, as they allow flexibility and continuous feedback.'
    ],
    [
        'question' => 'When should the V-Model be used?',
        'answer' => 'For projects requiring rigorous testing, such as medical or safety-critical systems.'
    ],
    [
        'question' => 'What SDLC model is best for rapid software development?',
        'answer' => 'RAD (Rapid Application Development) and Agile, as they prioritize fast prototyping and iterative improvements.'
    ],
    [
        'question' => 'What is a hybrid SDLC approach?',
        'answer' => 'A combination of different SDLC models, such as Water-Scrum-Fall (Waterfall + Agile) or Disciplined Agile Delivery (DAD).'
    ],
    [
        'question' => 'How does AI impact SDLC?',
        'answer' => 'AI optimizes development by automating testing, code generation, and risk management.'
    ],
    [
        'question' => 'What is DevSecOps?',
        'answer' => 'An extension of DevOps that integrates security practices throughout the SDLC.'
    ],
    [
        'question' => 'What is Shift-Left Testing?',
        'answer' => 'A practice that moves testing earlier in the development cycle to detect issues sooner.'
    ],
    [
        'question' => 'What is Value Stream Mapping in SDLC?',
        'answer' => 'A technique that focuses on optimizing the end-to-end software delivery process to improve efficiency.'
    ]
];


$stmt = $conn->prepare("INSERT INTO questions (question, answer) VALUES (?, ?)");
$stmt->bind_param("ss", $question, $answer);

foreach ($questions as $q) {
    $question = $q['question'];
    $answer = $q['answer'];
    $stmt->execute();
}

echo "Seeded " . count($questions) . " questions.\n";


$stmt->close();
$conn->close();

echo "Seeding completed successfully!\n";