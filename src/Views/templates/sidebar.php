<div class="bg-[#1A1D1F] h-full w-64 fixed top-0 left-0 shadow-lg flex flex-col">
    <div class="p-4 text-white text-2xl font-bold flex items-center gap-3">
        <img src="../../../public/assets/images/icons/box.svg" alt="OLX Logo" class="w-16 h-16 inline-block">
        <h1 class="text-4xl">Zephyr </h1>
    </div>

    <hr class="border-gray-700">

    <ul class="my-6 flex flex-col flex-grow gap-2">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/dashboard" class="text-md">
                <li class="menu-item px-4 py-3 mx-[8px] rounded-[16px] text-white hover:bg-[#272B30] hover:text-white flex items-center gap-2" data-url="/dashboard">
                    <img src="../../../public/assets/images/icons/dashboard.svg" alt="Dashboard" class="w-8 h-8 inline-block">
                    Dashboard
                </li>
            </a>
            <li class="mt-auto px-4 py-3 mx-[8px] rounded-[16px] text-white hover:bg-[#272B30] hover:text-white flex items-center gap-2">
                <form action="/logout" method="POST">
                    <img src="../../../public/assets/images/icons/logout.svg" alt="Logout" class="w-7 h-7 inline-block">
                    <button type="submit" class="text-md">Logout</button>
                </form>
            </li>
        <?php else: ?>
            <a href="/login">
                <li class="menu-item mx-[8px] rounded-[16px] px-4 py-3 text-white hover:bg-[#272B30] hover:text-white flex items-center gap-2 text-md" data-url="/login">
                    Log in
                </li>
            </a>
        <?php endif; ?>
    </ul>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the current URL path
    const currentUrl = window.location.pathname;

    // Get all menu items
    const menuItems = document.querySelectorAll('.menu-item');

    // Loop through menu items and add active class to the matching item
    menuItems.forEach(item => {
        if (item.getAttribute('data-url') === currentUrl) {
            item.classList.add('bg-[#272B30]'); // Highlight the active item
            item.querySelector('a').classList.add('text-[#E2E2E2]'); // Optional: Change text color
        }
    });
});
</script>
