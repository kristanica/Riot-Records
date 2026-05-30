<?php
session_start();

include_once __DIR__ . "/php/getArtist.php"; // $aboutParamore, $members, $formerMembers, $timeline
include_once __DIR__ . "/php/hardCodedInfo.php";


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
    <title>Dashboard</title>
    <link rel="icon" href="./assets/paramore-icon.png">
    <link rel="stylesheet" href="scroll.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:ital,wght@0,100..900;1,100..900&family=Jersey+10&display=swap" rel="stylesheet">
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

<body class="min-h-screen min-w-screen bg-[#0d0d10] text-zinc-100 font-exo">
    <!-- Background -->
    <div class="fixed inset-0 bg-gradient-to-b from-[#0d0d10] via-[#111117] to-[#15151b] -z-10"></div>

    <!-- Navigation -->
    <div class="fixed top-0 left-0 right-0 z-10 bg-[#0d0d10]/80 backdrop-blur border-b border-white/10 px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-6">
            <a href="dashboard.php" class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition">Home</a>
            <a href="album.php" class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition">Album</a>
            <a href="tracks.php" class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition">Tracks</a>
            <a href="allReleases.php" class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition">All Releases</a>
            <a href="comments.php" class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition">Comments</a>
            <a href="quiz.php" class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition">Quiz</a>
        </div>
        <div class="flex items-center gap-4">
            <?php if (isset($_SESSION["id"])): ?>
                <form method="post">
                    <button type="submit" name="logout" class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition">Log out</button>
                </form>
            <?php else: ?>
                <a href="register.php" class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition">Register</a>
                <a href="login.php" class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <main class="pt-24 pb-16 space-y-16">
        <!-- Hero Section -->
        <div class="relative text-white flex justify-center items-center flex-col text-center px-6 pt-8 pb-6">
            <img src="./assets/optimized-logo-gif.webp" class="w-12 h-12 mb-4 opacity-90">
            <p class="text-[11px] uppercase tracking-[0.35em] text-zinc-400">Explore the albums, tracks, and the story</p>
        </div>

        <!-- Divider -->
        <div class="max-w-5xl mx-auto h-px bg-white/10"></div>

        <!-- About Paramore -->
        <div id="about" class="max-w-4xl mx-auto px-6">
            <h1 class="text-xl uppercase tracking-[0.35em] text-white mb-4">Paramore</h1>
            <div class="w-full h-44 overflow-hidden rounded-xl border border-white/10">
                <img src="./assets/images/concert.jpg" class="w-full h-full object-cover">
            </div>
            <p class="text-sm text-zinc-300 leading-relaxed mt-4"><?php echo $aboutParamore["bio"]["content"]; ?></p>
        </div>

        <!-- Members -->
        <div class="max-w-5xl mx-auto px-6">
            <h1 class="text-xl uppercase tracking-[0.35em] text-white mb-6">Members</h1>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($members as $member): ?>
                    <div class="flex flex-col items-center bg-[#15151b] border border-white/10 rounded-xl p-5 transition hover:-translate-y-1 hover:border-[#ff4d5a]/40">
                        <img src="<?= $member['photo'] ?>" alt="<?= $member['name'] ?>" class="w-24 h-24 rounded-full mb-4 object-cover border border-white/10">
                        <p class="font-semibold text-base text-center mb-1"><?= $member['name'] ?></p>
                        <p class="text-[#ff4d5a] text-sm mb-1 text-center"><?= $member['role'] ?></p>
                        <p class="text-zinc-400 text-xs mb-2 text-center"><?= $member['year'] ?></p>
                        <p class="text-center text-zinc-300 text-sm"><?= $member['bio'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Former Members -->
        <div class="max-w-5xl mx-auto px-6">
            <h1 class="text-xl uppercase tracking-[0.35em] text-white mb-6">Former Members</h1>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($formerMembers as $member): ?>
                    <div class="flex flex-col items-center bg-[#15151b] border border-white/10 rounded-xl p-5 transition hover:-translate-y-1 hover:border-[#ff4d5a]/40">
                        <img src="<?= $member['photo'] ?>" alt="<?= $member['name'] ?>" class="w-24 h-24 rounded-full mb-4 object-cover border border-white/10">
                        <p class="font-semibold text-base text-center mb-1"><?= $member['name'] ?></p>
                        <p class="text-[#ff4d5a] text-sm mb-1 text-center"><?= $member['role'] ?></p>
                        <p class="text-zinc-400 text-xs mb-2 text-center"><?= $member['year'] ?></p>
                        <p class="text-center text-zinc-300 text-sm"><?= $member['bio'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Timeline -->
        <section id="timeline" class="max-w-4xl mx-auto px-6">
            <h1 class="text-white text-xl uppercase tracking-[0.35em] text-center mb-6">The Timeline</h1>
            <div class="relative mt-8 pl-6">
                <div class="absolute left-2 top-0 bottom-0 w-px bg-white/10"></div>
                <?php foreach ($timeline as $item): ?>
                    <div class="relative pb-8">
                        <div class="absolute left-0 top-2 w-3 h-3 bg-[#ff4d5a] rounded-full border border-[#0d0d10]"></div>
                        <div class="ml-6 bg-[#15151b] border border-white/10 rounded-2xl p-5">
                            <div class="flex flex-wrap items-center gap-3 text-[11px] uppercase tracking-[0.3em] text-zinc-400">
                                <span class="text-[#ff4d5a] font-semibold"><?= $item["year"] ?></span>
                                <span class="text-zinc-500">•</span>
                                <span><?= $item["title"] ?></span>
                            </div>
                            <p class="text-sm text-zinc-300 mt-3 leading-relaxed"><?= $item["text"] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

    </main>

    <!-- Footer -->
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

</body>

</html>