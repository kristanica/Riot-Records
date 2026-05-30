<?php include_once __DIR__ . "/php/getArtist.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramore</title>
    <link rel="icon" href="./assets/paramore-icon.png">
    <link rel="stylesheet" href="scroll.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@200..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .hero-glow {
            background: radial-gradient(60% 40% at 50% 0%, rgba(255, 77, 90, 0.16), rgba(13, 13, 16, 0));
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        exo: ['"Exo"', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-[#0d0d10] min-h-screen relative overflow-hidden font-exo text-zinc-100">

    <div class="absolute inset-0 bg-gradient-to-b from-[#0d0d10] via-[#111117] to-[#15151b]"></div>
    <div class="absolute inset-0 hero-glow"></div>

    <main class="relative z-10 flex flex-col items-center justify-center min-h-screen text-center px-6">
        <img src="./assets/paramore-icon.png" class="w-20 md:w-24 mb-6 opacity-90">

        <p class="text-xs uppercase tracking-[0.4em] text-zinc-400 mb-3">Paramore Archive</p>
        <h1 class="text-4xl md:text-6xl font-semibold tracking-[0.3em] text-white mb-5">
            PARAMORE
        </h1>

        <p class="max-w-xl text-sm md:text-base leading-relaxed text-zinc-300 mb-8">
            <?php echo $aboutParamore["bio"]["summary"] ?>
        </p>

        <a href="dashboard.php"
            class="inline-flex items-center justify-center rounded-full border border-white/20 px-10 py-3 text-[11px] uppercase tracking-[0.35em] text-white hover:border-[#ff4d5a] hover:text-[#ff4d5a] transition">
            Enter
        </a>
    </main>



</body>

</html>
