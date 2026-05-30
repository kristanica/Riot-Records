<?php
session_start();

include_once __DIR__ . "/php/CRUD/retrieveComment.php";
include_once __DIR__ . "/php/CRUD/editComment.php";
include_once __DIR__ . "/php/CRUD/deleteComment.php";
include_once __DIR__ . "/php/CRUD/createComment.php";

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

<body class="min-h-screen min-w-screen bg-[#0d0d10] text-zinc-100 font-exo">

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
            <?php if (isset($_SESSION["id"])): ?>
                <form method="post">
                    <button type="submit" name="logout"
                        class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition">Log out</button>
                </form>
            <?php else: ?>
                <a class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition" href="register.php">Register</a>
                <a class="text-[11px] uppercase tracking-[0.3em] text-zinc-300 hover:text-white transition" href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <header class="pt-24 pb-10 flex flex-col items-center text-center">
        <img src="./assets/optimized-logo-gif.webp" class="h-12 w-12 opacity-80">
        <p class="text-sm text-zinc-400 tracking-wide mt-4">From first track to last hit—All Paramore.</p>
    </header>

    <main class="pb-16">
        <section class="max-w-5xl mx-auto px-6 space-y-8">
            <div class="grid gap-6 md:grid-cols-[1.2fr_1fr] items-stretch">
                <div class="w-full h-48 md:h-full overflow-hidden rounded-2xl border border-white/10">
                    <img src="./assets/images/concert.jpg" class="w-full h-full object-cover">
                </div>
                <div class="bg-[#15151b] border border-white/10 rounded-2xl p-6 flex flex-col justify-between">
                    <div>
                        <p class="text-[11px] uppercase tracking-[0.35em] text-zinc-400">Community</p>
                        <h2 class="text-lg font-semibold text-white mt-3">Notes from fans</h2>
                        <p class="text-sm text-zinc-300 mt-3 leading-relaxed">Short, honest takes from the Paramore community—albums, eras, and everything in between.</p>
                    </div>
                    <div class="mt-6 text-[11px] uppercase tracking-[0.35em] text-[#ff4d5a]">Latest comments</div>
                </div>
            </div>

            <form method="post" class="bg-[#15151b] border border-white/10 rounded-2xl p-6">
                <div class="mb-4">
                    <label class="pl-1 text-[11px] uppercase tracking-[0.3em] text-zinc-400">Add a comment</label>
                    <div class="mt-3">
                        <textarea name="comment" required class="w-full px-4 py-3 h-28 rounded-lg bg-transparent text-white border border-white/10 focus:border-[#ff4d5a] focus:ring-2 focus:ring-[#ff4d5a]/20 outline-none"></textarea>
                    </div>
                </div>
                <?php if (isset($_SESSION["id"])): ?>
                    <div class="text-right">
                        <button type="submit" name="createComment" class="rounded-full border border-white/20 px-8 py-3 text-[11px] uppercase tracking-[0.35em] text-white hover:border-[#ff4d5a] hover:text-[#ff4d5a] transition">Submit</button>
                    </div>
                <?php else: ?>
                    <p class="text-center text-[11px] uppercase tracking-[0.35em] text-zinc-400 border border-white/10 rounded-full px-6 py-3">Login first to create a comment</p>
                <?php endif; ?>
            </form>

            <div class="space-y-4">
                <!-- COMMENTS LOOP -->
                <?php foreach ($comment as $comm): ?>
                    <div class="comment-card bg-[#15151b] border border-white/10 rounded-2xl p-5">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-3">
                            <div>
                                <p class="text-[#ff4d5a] font-semibold text-base">
                                    <?= htmlspecialchars($comm["username"]) ?>
                                </p>
                                <p class="text-zinc-400 text-xs"><?= htmlspecialchars($comm["email"]) ?></p>
                            </div>

                            <div class="flex items-center gap-2">
                                <?php if (isset($_SESSION["id"]) && $_SESSION["id"] == $comm["user_id"]): ?>
                                    <button class="edit-btn border border-white/20 text-white px-3 py-1 rounded-full text-[11px] uppercase tracking-[0.3em] hover:border-[#ff4d5a] hover:text-[#ff4d5a] transition"
                                        data-comment-id="<?= $comm['comment_id'] ?>">
                                        Edit
                                    </button>

                                    <button class="dlt-btn border border-white/20 text-white px-3 py-1 rounded-full text-[11px] uppercase tracking-[0.3em] hover:border-[#ff4d5a] hover:text-[#ff4d5a] transition"
                                        data-comment-id="<?= $comm['comment_id'] ?>">
                                        Delete
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Comment Text -->
                        <p class="comment-text text-zinc-200 text-sm leading-relaxed">
                            <?= htmlspecialchars($comm["comment"]) ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

    </main>

    <!-- EDIT MODAL -->
    <div id="editCommentModal"
        class="fixed inset-0 bg-black/70 backdrop-blur-sm flex justify-center items-center hidden z-50">
        <div class="bg-[#15151b] border border-white/10 p-8 rounded-2xl w-[90%] max-w-md text-center relative">
            <h2 class="text-sm uppercase tracking-[0.35em] text-[#ff4d5a] mb-4">Edit Comment</h2>

            <button onclick="closeEditModal()" class="absolute top-3 right-3 text-white text-xl">&times;</button>

            <form method="post">
                <input type="hidden" name="comment_id" id="editCommentID">
                <input type="text" name="editComment" id="editCommentInput"
                    class="text-white w-full p-3 rounded-lg bg-transparent border border-white/10 focus:border-[#ff4d5a] focus:ring-2 focus:ring-[#ff4d5a]/20 outline-none">
                <button type="submit" name="updateComment"
                    class="mt-4 w-full rounded-full border border-white/20 px-6 py-2 text-[11px] uppercase tracking-[0.35em] text-white hover:border-[#ff4d5a] hover:text-[#ff4d5a] transition">Save</button>
            </form>
        </div>
    </div>

    <!-- DELETE MODAL -->
    <div id="deleteModal"
        class="fixed inset-0 bg-black/70 backdrop-blur-sm flex justify-center items-center hidden z-50">

        <div class="bg-[#15151b] border border-white/10 p-8 rounded-2xl w-[90%] max-w-md text-center">
            <h2 class="text-sm uppercase tracking-[0.35em] text-[#ff4d5a] mb-4">Confirm Delete</h2>

            <form method="post">
                <input type="hidden" name="deleteCommentId" id="deleteCommentID">
                <button type="submit" name="deleteComment"
                    class="rounded-full border border-white/20 px-6 py-2 text-[11px] uppercase tracking-[0.35em] text-white hover:border-[#ff4d5a] hover:text-[#ff4d5a] transition">
                    Yes, delete
                </button>
                <button type="button" id="cancelDelete"
                    class="ml-4 rounded-full border border-white/20 px-6 py-2 text-[11px] uppercase tracking-[0.35em] text-white hover:border-white hover:text-white transition">
                    Cancel
                </button>
            </form>
        </div>
    </div>

    <!-- FOOTER -->
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
            </div>
        </div>
    </footer>


    <script>
        // EDIT BUTTON
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                let id = btn.getAttribute('data-comment-id');
                let commentText = btn.closest('.comment-card').querySelector('.comment-text').innerText;

                document.getElementById("editCommentID").value = id;
                document.getElementById("editCommentInput").value = commentText;

                document.getElementById("editCommentModal").classList.remove("hidden");
            });
        });

        function closeEditModal() {
            document.getElementById("editCommentModal").classList.add("hidden");
        }

        // DELETE BUTTON
        document.querySelectorAll('.dlt-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                let id = btn.getAttribute('data-comment-id');
                document.getElementById("deleteCommentID").value = id;

                document.getElementById("deleteModal").classList.remove("hidden");
            });
        });

        document.getElementById("cancelDelete").addEventListener("click", () => {
            document.getElementById("deleteModal").classList.add("hidden");
        });
    </script>

</body>

</html>