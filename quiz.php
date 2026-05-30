<?php
session_start();

if (isset($_POST["logout"])) {
    $_SESSION = [];
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramore Quiz</title>
    <link rel="icon" href="./assets/paramore-icon.png">
    <link rel="stylesheet" href="scroll.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        exo: ['"Exo"', 'sans-serif'],
                    },
                },
            },
        };
    </script>
</head>

<body class="min-h-screen min-w-screen bg-[#0d0d10] text-zinc-100 font-exo flex flex-col">
    <div class="fixed inset-0 bg-gradient-to-b from-[#0d0d10] via-[#111117] to-[#15151b] -z-10"></div>

    <div class="fixed top-0 left-0 right-0 z-10 bg-[#0d0d10]/80 backdrop-blur border-b border-white/10 px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-6">
            <a class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition" href="dashboard.php">Home</a>
            <a class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition" href="album.php">Album</a>
            <a class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition" href="tracks.php">Tracks</a>
            <a class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition" href="allReleases.php">All Releases</a>
            <a class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition" href="comments.php">Comments</a>
            <a class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition" href="quiz.php">Quiz</a>
        </div>
        <div class="flex items-center gap-4">
            <?php if (isset($_SESSION["id"])): ?>
                <form method="post">
                    <button type="submit" name="logout" class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition">Log out</button>
                </form>
            <?php else: ?>
                <a class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition" href="register.php">Register</a>
                <a class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition" href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <header class="pt-24 pb-10 flex flex-col items-center text-center">
        <img src="./assets/optimized-logo-gif.webp" class="h-12 w-12 opacity-80">
        <p class="text-sm text-zinc-400 tracking-wide mt-4">Test your Paramore knowledge.</p>
    </header>

    <main class="pb-16 flex-1">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-[#15151b] border border-white/10 p-8 rounded-2xl text-white" id="quizContainer">
                <h1 class="text-xl uppercase tracking-[0.35em] text-center mb-6">Paramore Quiz</h1>

                <?php if (isset($_SESSION["id"])): ?>
                    <div id="quizWarning" class="hidden text-center text-[11px] uppercase tracking-[0.35em] text-[#ff4d5a] border border-[#ff4d5a]/40 rounded-full px-6 py-3 mb-6">
                        Quiz data failed to load. Please refresh to try again.
                    </div>
                    <p id="quizQuestion" class="text-center text-[#ff4d5a] mb-8 text-base md:text-lg font-semibold"></p>

                    <form id="quizForm" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <?php foreach (['a', 'b', 'c', 'd'] as $key): ?>
                                <div data-option="<?= $key ?>" class="quiz-option cursor-pointer bg-[#1b1b22] border border-white/10 hover:border-[#ff4d5a] hover:text-[#ff4d5a] transition-colors duration-200 rounded-lg p-4 text-center font-medium select-none">
                                    <span class="mr-2 font-bold"><?= strtoupper($key) ?>.</span>
                                    <span id="choice-<?= $key ?>"></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </form>
                <?php else: ?>
                    <p class="text-center text-[11px] uppercase tracking-[0.35em] text-zinc-400 border border-white/10 rounded-full px-6 py-3">Login first to take the quiz</p>
                <?php endif; ?>
                <div id="quizResult" class="mt-6 text-center text-xl font-bold hidden"></div>
            </div>
        </div>
    </main>

    <footer class="bg-[#0b0b0d] border-t border-white/10 mt-14">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-6 py-10">
            <div class="flex flex-col justify-center items-center">
                <img src="./assets/optimized-logo-gif.webp" class="h-14 w-14 opacity-80">
            </div>
            <div class="flex flex-col justify-center gap-2">
                <a href="dashboard.php" class="text-xs uppercase tracking-[0.3em] text-zinc-400 hover:text-white transition">Home</a>
                <a href="album.php" class="text-xs uppercase tracking-[0.3em] text-zinc-400 hover:text-white transition">Album</a>
                <a href="tracks.php" class="text-xs uppercase tracking-[0.3em] text-zinc-400 hover:text-white transition">Tracks</a>
                <a href="allReleases.php" class="text-xs uppercase tracking-[0.3em] text-zinc-400 hover:text-white transition">All Releases</a>
                <a href="quiz.php" class="text-xs uppercase tracking-[0.3em] text-zinc-400 hover:text-white transition">Quiz</a>
            </div>
            <div class="flex flex-col justify-center text-center md:text-left space-y-3">
                <h2 class="text-xs uppercase tracking-[0.3em] text-zinc-400">Follow Paramore</h2>
                <div class="flex justify-center md:justify-start gap-4 text-xl">
                    <a href="#" class="hover:text-[#ff4d5a] transition">🎵</a>
                    <a href="#" class="hover:text-[#ff4d5a] transition">📸</a>
                    <a href="#" class="hover:text-[#ff4d5a] transition">▶️</a>
                </div>
                <p class="text-sm text-zinc-400">Updates, concerts, announcements & more.</p>
            </div>
            <div class="col-span-1 md:col-span-3 text-center border-t border-white/10 pt-6 mt-6">
                <p class="text-zinc-500 text-[11px]">© <?= date("Y") ?> Paramore Fan Page — For educational use only.</p>
            </div>
        </div>
    </footer>

    <script>
        const quizQuestion = document.getElementById("quizQuestion");
        if (quizQuestion) {
            const quizWarning = document.getElementById("quizWarning");
            let correctAnswer;
            let answered;

            async function loadQuiz() {
                if (quizWarning) {
                    quizWarning.classList.add("hidden");
                }
                try {
                    const res = await fetch("php/generateQuestion.php");
                    if (!res.ok) {
                        throw new Error("Quiz request failed");
                    }
                    const data = await res.json();
                    if (!data || !data.correctAnswer || !data.question) {
                        throw new Error("Quiz payload invalid");
                    }
                    correctAnswer = data.correctAnswer;
                    quizQuestion.textContent = data.question;
                    ['a', 'b', 'c', 'd'].forEach(key => {
                        document.getElementById("choice-" + key).textContent = data[key] || "";
                        const optionDiv = document.querySelector(`[data-option="${key}"]`);
                        optionDiv.classList.remove("bg-green-500", "bg-red-500", "text-black", "text-white");
                    });
                    document.getElementById("quizResult").classList.add("hidden");
                    answered = false;
                } catch (err) {
                    if (quizWarning) {
                        quizWarning.classList.remove("hidden");
                    }
                }
            }

            loadQuiz();

            document.querySelectorAll(".quiz-option").forEach(option => {
                option.addEventListener("click", () => {
                    if (answered) return;
                    answered = true;
                    const selected = option.getAttribute("data-option");

                    if (selected === correctAnswer) {
                        option.classList.add("bg-green-500", "text-white");
                    } else {
                        option.classList.add("bg-red-500", "text-white");
                        document.querySelector(`[data-option="${correctAnswer}"]`).classList.add("bg-green-500", "text-white");
                    }
                    setTimeout(loadQuiz, 1500);
                });
            });
        }
    </script>
</body>

</html>
