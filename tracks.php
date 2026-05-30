<?php
// ensure getAlbum.php run only once
session_start();
include_once __DIR__ . "/php/getAlbum.php";
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
    <title>Tracks</title>
    <link rel="icon" href="./assets/paramore-icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="scroll.css">
    <link href="https://fonts.googleapis.com/css2?family=Exo:ital,wght@0,100..900;1,100..900&family=Jersey+10&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        exo: ['"Exo"', 'sans-serif'], // Example for overriding default sans-serif

                    },
                },
            },
        };
    </script>


</head>

<body class="min-h-screen min-w-screen bg-[#0d0d10] text-zinc-100 font-exo">
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

            <!-- Checks wether user is login -->
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
        <p class="text-sm text-zinc-400 tracking-wide mt-4">From “All We Know” to “This Is Why”—every track matters.</p>

    </header>
    <main>
        <div id="albums" class="max-w-6xl mx-auto px-6 pb-16 space-y-6">


            <!-- Display filteredalbums as album -->
            <?php foreach ($filteredAlbums as $album): ?>
                <div class="trackContent group relative transition-all duration-500 w-full cursor-pointer bg-[#15151b] border border-white/10 rounded-2xl p-5 hover:-translate-y-1 hover:border-[#ff4d5a]/40">
                    <div class="grid gap-5 md:grid-cols-[220px_1fr] items-start">
                        <div class="relative overflow-hidden rounded-xl border border-white/10">
                            <!-- Retrieves the image -->
                            <img src="<?= $album["image"] ?>" class="w-full h-52 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0d0d10]/70 via-transparent to-transparent"></div>
                            <div class="absolute bottom-3 left-3">
                                <p class="text-[10px] uppercase tracking-[0.3em] text-zinc-400">Tracks</p>
                                <p class="text-sm uppercase tracking-[0.3em] text-white"><?= $album["name"] ?></p>
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-[10px] uppercase tracking-[0.3em] text-zinc-400">Tracklist</p>
                                    <p class="text-white text-sm uppercase tracking-[0.3em] mt-1"><?= $album["name"] ?></p>
                                    <p class="text-zinc-400 text-xs mt-1"><?= count($album["trackDetails"]) ?> tracks</p>
                                </div>
                                <span class="text-[10px] uppercase tracking-[0.3em] text-zinc-400">Click to expand</span>
                            </div>

                            <div class="albumDetails max-h-0 overflow-hidden transition-all duration-500 ease-in-out opacity-0 pointer-events-none mt-4 border-t border-white/10 pt-4">
                                <div class="overflow-y-auto max-h-[300px] pr-2">
                                    <?php foreach ($album["trackDetails"] as $track): ?>
                                        <?php
                                        $minutes = floor($track["trackDuration"] / 60);
                                        $seconds = $track["trackDuration"] % 60;
                                        $formattedDuration = sprintf("%d:%02d", $minutes, $seconds);
                                        ?>
                                        <div class="flex items-center justify-between text-zinc-200 text-sm py-2 border-b border-white/5 last:border-b-0">
                                            <span class="truncate"><?= $track["trackName"] ?></span>
                                            <span class="text-zinc-400 text-xs"><?= $formattedDuration ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            <?php endforeach; ?>
        </div>

    </main>


    <!-- SImple footer -->
    <footer class="bg-[#0b0b0d] border-t border-white/10">
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

                <p class="text-sm text-zinc-400">
                    Updates, concerts, announcements & more.
                </p>
            </div>
            <div class="col-span-1 md:col-span-3 text-center border-t border-white/10 pt-6 mt-6">
                <p class="text-zinc-500 text-[11px]">
                    © <?= date("Y") ?> Paramore Fan Page — For educational use only.
                </p>
            </div>
        </div>


    </footer>

    <script>
        // Expand transition when album clicked
        const trackContent = document.querySelectorAll(".trackContent");

        trackContent.forEach((item, index) => {
            item.addEventListener("click", () => {
                const albumDetails = document.querySelectorAll(".albumDetails");
                albumDetails[index].classList.toggle("max-h-0");
                albumDetails[index].classList.toggle("max-h-[500px]");
                albumDetails[index].classList.toggle("opacity-0");
                albumDetails[index].classList.toggle("opacity-100");
                albumDetails[index].classList.toggle("pointer-events-none");
                albumDetails[index].addEventListener("click", (e) => {
                    e.stopPropagation();
                });

            });
        });
    </script>
</body>

</html>