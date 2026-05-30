<?php


session_start();
include_once __DIR__ . "/php/CRUD/retrieveProducts.php";
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
    <title>Comments</title>
    <link rel="icon" href="./assets/paramore-icon.png">
    <link rel="stylesheet" href="scroll.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:ital,wght@0,100..900;1,100..900&family=Jersey+10&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/566c00e5db.js" crossorigin="anonymous"></script>

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

<body class="min-h-screen min-w-screen bg-[#0d0d10] text-zinc-100 font-exo relative">
    <!-- Background -->
    <div class="fixed inset-0 bg-gradient-to-b from-[#0d0d10] via-[#111117] to-[#15151b] -z-10"></div>
    <!-- Navigation -->
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
            <?php
            if (isset($_SESSION["id"])) {
            ?>
                <form method="post">
                    <button type="submit" name="logout" class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition">Log out</button>
                </form>
            <?php } else { ?>
                <a class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition" href="register.php">Register</a>
                <a class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition" href="login.php">Login</a>
            <?php } ?>
        </div>
    </div>
    <header class="pt-24 pb-10 flex flex-col items-center text-center">
        <img src="./assets/optimized-logo-gif.webp" class="h-12 w-12 opacity-80">
        <p class="text-sm text-zinc-400 tracking-wide mt-4">From first track to last hit—All Paramore.</p>
        <p class="text-xs uppercase tracking-[0.3em] text-[#ff4d5a] mt-3">Currently under maintenance</p>

    </header>
    <main>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto px-6 pb-16">
            <!-- Grain overlay -->
            <?php foreach ($prod as $merch): ?>
                <div class="bg-[#15151b] border border-white/10 rounded-2xl p-6">
                    <img src="./assets/images/merch/<?= $merch["name"] . ".webp" ?>" class="h-64 w-64 mx-auto object-contain">
                    <div class="mt-6">

                        <p class="text-sm uppercase tracking-[0.3em]"><?= $merch["name"] ?></p>
                        <p class="text-xs uppercase tracking-[0.3em] text-zinc-400 mt-3"><?= $merch["category"] ?></p>
                        <p class="text-zinc-200 mt-2"><?= "£ " . $merch["price"] ?></p>
                        <button class="mt-5 w-full rounded-full border border-white/20 px-6 py-2 text-[11px] uppercase tracking-[0.35em] text-white hover:border-[#ff4d5a] hover:text-[#ff4d5a] transition">
                            Sold out
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>



        <i class="fa-solid fa-basket-shopping bottom-6 fixed right-6 text-2xl text-zinc-400"></i>

    </main>
    <!-- Footer -->
    <footer class="bg-[#0b0b0d] border-t border-white/10 mt-14">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-6 py-10">
            <div class="flex flex-col justify-center items-center">
                <img src="./assets/optimized-logo-gif.webp" class="h-14 w-14 opacity-80">
            </div>
            <div class="flex flex-col justify-center gap-2">
                <a class="text-xs uppercase tracking-[0.3em] text-zinc-400 hover:text-white transition" href="dashboard.php">Home</a>
                <a class="text-xs uppercase tracking-[0.3em] text-zinc-400 hover:text-white transition" href="album.php">Album</a>
                <a class="text-xs uppercase tracking-[0.3em] text-zinc-400 hover:text-white transition" href="tracks.php">Tracks</a>
                <a class="text-xs uppercase tracking-[0.3em] text-zinc-400 hover:text-white transition" href="allReleases.php">All Releases</a>
                <a class="text-xs uppercase tracking-[0.3em] text-zinc-400 hover:text-white transition" href="quiz.php">Quiz</a>
            </div>
            <div class="flex flex-col justify-center text-center md:text-left space-y-3">
                <h2 class="text-xs uppercase tracking-[0.3em] text-zinc-400">Follow Paramore</h2>
                <div class="flex justify-center md:justify-start gap-4 text-xl">
                    <a class="hover:text-[#ff4d5a] transition">🎵</a>
                    <a class="hover:text-[#ff4d5a] transition">📸</a>
                    <a class="hover:text-[#ff4d5a] transition">▶️</a>
                </div>
                <p class="text-sm text-zinc-400">Updates, concerts, announcements & more.</p>
            </div>
            <div class="col-span-1 md:col-span-3 text-center border-t border-white/10 pt-6 mt-6">
                <p class="text-zinc-500 text-[11px]">
                    © <?= date("Y") ?> Paramore Fan Page — For educational use only.
                </p>
            </div>
        </div>
    </footer>

</body>

</html>