<?php
// Ensure getALbum only run once
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
    <title>Album</title>
    <link rel="icon" href="./assets/paramore-icon.png">
    <link rel="stylesheet" href="scroll.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:ital,wght@0,100..900;1,100..900&family=Jersey+10&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>


    <!-- Estabishes tailwind config for style -->
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
        <p class="text-sm text-zinc-400 tracking-wide mt-4">From first track to last hit—All Paramore.</p>
    </header>


    <main>
        <?php
        $featuredAlbum = $filteredAlbums[0] ?? null;
        $albumList = $featuredAlbum ? array_slice($filteredAlbums, 1) : [];
        ?>
        <div class="max-w-6xl mx-auto px-6 pb-16 grid grid-cols-1 lg:grid-cols-[1.1fr_1.4fr] gap-8">
            <?php if ($featuredAlbum): ?>
                <?php
                $featuredSummary = strip_tags($featuredAlbum["about"] ?? "");
                if (strlen($featuredSummary) > 260) {
                    $featuredSummary = substr($featuredSummary, 0, 260) . "...";
                }
                ?>
                <aside class="lg:sticky lg:top-24 h-fit">
                    <div class="overflow-hidden rounded-2xl border border-white/10 bg-[#15151b]">
                        <div class="relative">
                            <img class="w-full h-72 object-cover" src="<?= $featuredAlbum["image"] ?>" alt="<?= $featuredAlbum['name'] ?>">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0d0d10]/85 via-transparent to-transparent"></div>
                            <div class="absolute bottom-4 left-4 right-4">
                                <p class="text-[10px] uppercase tracking-[0.3em] text-zinc-400">Featured album</p>
                                <h1 class="text-white text-base uppercase tracking-[0.3em] mt-2"><?= $featuredAlbum["name"] ?></h1>
                                <p class="text-zinc-400 text-xs mt-1"><?= $featuredAlbum["year"] ?></p>
                            </div>
                        </div>
                        <div class="p-6 border-t border-white/10">
                            <p class="text-zinc-300 text-sm leading-relaxed"><?= $featuredSummary ?></p>
                            <div class="mt-4 flex items-center justify-between text-xs uppercase tracking-[0.3em] text-zinc-400">
                                <span>Playcount</span>
                                <span class="text-[#ff4d5a]"><?= $featuredAlbum["playCount"] ?></span>
                            </div>
                        </div>
                    </div>
                </aside>
            <?php endif; ?>

            <section class="space-y-4">
                <?php foreach ($albumList as $album): ?>
                    <div class="albumContent bg-[#15151b] border border-white/10 rounded-2xl p-5 transition hover:-translate-y-1 hover:border-[#ff4d5a]/40">
                        <div class="flex flex-col md:flex-row gap-5">
                            <img class="w-full md:w-40 h-40 object-cover rounded-xl border border-white/10" src="<?= $album["image"] ?>" alt="<?= $album['name'] ?>">
                            <div class="flex-1">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="text-[10px] uppercase tracking-[0.3em] text-zinc-400">Album</p>
                                        <h2 class="text-white text-sm uppercase tracking-[0.3em] mt-1"><?= $album["name"] ?></h2>
                                        <p class="text-zinc-400 text-xs mt-1"><?= $album["year"] ?></p>
                                    </div>
                                    <button class="moreButton w-9 h-9 rounded-full bg-transparent border border-white/20 text-zinc-200 hover:border-[#ff4d5a] hover:text-[#ff4d5a] transition">˅</button>
                                </div>
                                <div class="albumDetails max-h-0 overflow-hidden transition-all duration-500 mt-4 border-t border-white/10 pt-4">
                                    <p class="text-zinc-300 text-sm text-justify"><?= $album["about"] ?></p>
                                    <div class="mt-4 flex items-center justify-between text-xs uppercase tracking-[0.3em] text-zinc-400">
                                        <span>Playcount</span>
                                        <span class="text-[#ff4d5a]"><?= $album["playCount"] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </section>
        </div>
    </main>



    <!-- Simple footer -->
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
                <a class="text-xs uppercase tracking-[0.3em] text-zinc-400 hover:text-white transition" href="comments.php">Comments</a>
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
                    <!-- Prints year -->
                    © <?= date("Y") ?> Paramore Fan Page — For school project only.
                </p>
            </div>
        </div>


    </footer>
    <script>
        // Byutton expand logic
        const moreButton = document.querySelectorAll(".moreButton")
        moreButton.forEach((item, index) => {
            item.addEventListener("click", () => {
                const albumDetails = document.querySelectorAll(".albumDetails");

                let isOpen = false;
                albumDetails[index].classList.toggle("max-h-0", !isOpen);
                isOpen = albumDetails[index].classList.toggle("max-h-[500px]");

                item.textContent = isOpen ? "˄" : "˅";

            })
        })
    </script>
</body>

</html>