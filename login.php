<?php
session_start();

include_once __DIR__ . "/php/CRUD/login.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

<body class="min-h-screen min-w-screen bg-[#0d0d10] text-zinc-100 flex-col font-exo flex justify-center items-center">

    <div class="fixed inset-0 bg-gradient-to-b from-[#0d0d10] via-[#111117] to-[#15151b] -z-10"></div>

    <main class="w-full max-w-md px-6">

        <img src="./assets/optimized-logo-gif.webp" class="h-16 w-16 mx-auto opacity-90">

        <form method="post" class="bg-[#15151b]/80 rounded-2xl mt-6 p-8 border border-white/10">

            <div class="pb-6 border-b border-white/10">
                <h1 class="text-center text-lg tracking-[0.35em] text-white">PARAMORE</h1>
                <p class="text-center font-exo text-[11px] uppercase tracking-[0.25em] text-zinc-400 mt-2">All the albums. All the hits. All Paramore.</p>
            </div>

            <div class="mt-6">
                <label class="pl-1 text-[11px] uppercase tracking-[0.3em] text-zinc-400">Email</label>
                <div class="mt-2">
                    <input class="w-full px-4 py-3 rounded-lg bg-transparent text-white border border-white/10 focus:border-[#ff4d5a] focus:ring-2 focus:ring-[#ff4d5a]/20 outline-none" name="email" type="email" required>
                </div>
            </div>
            <div class="mt-4">
                <label class="pl-1 text-[11px] uppercase tracking-[0.3em] text-zinc-400">Password</label>
                <div class="mt-2">
                    <input class="w-full px-4 py-3 rounded-lg bg-transparent text-white border border-white/10 focus:border-[#ff4d5a] focus:ring-2 focus:ring-[#ff4d5a]/20 outline-none" name="password" type="password" required>
                </div>
            </div>

            <div class="mt-6 text-center">
                <button type="submit" name="login" class="w-full rounded-full border border-white/20 px-6 py-3 text-[11px] uppercase tracking-[0.35em] text-white hover:border-[#ff4d5a] hover:text-[#ff4d5a] transition">Login</button>
            </div>
        </form>

    </main>


</body>

</html>