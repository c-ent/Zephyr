<?php require __DIR__ . '/templates/header.php'; ?>

<div class="min-h-screen flex items-center justify-center bg-[#121212]">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <div class="flex items-center mb-4">
            <img src="../../public/assets/images/icons/boxdark.svg" alt="OLX Logo" class="w-16 h-16 inline-block">
            <h1 class="text-4xl font-bold   text-[#121212]">Sign in</h1>
        </div>
       
        <?php if (isset($error)): ?>
            <p class="text-red-500 mb-4 text-center"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form action="/login" method="POST">
            <div class="mb-6">
                <label for="username" class="block text-gray-700 mb-2">Username</label>
                <input type="text" id="username" name="username" required class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-300">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 mb-2">Password</label>
                <input type="password" id="password" name="password" required class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-300">
            </div>
            <button id="loginsubmit" type="submit" class="w-full bg-[#121212] text-white py-3 px-4 rounded-md hover:bg-[#131313] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Login</button>
        </form>
    </div>
</div>

<?php require __DIR__ . '/templates/footer.php'; ?>
