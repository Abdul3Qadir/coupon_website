document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('notificationDropdownContainer');
    const bell = document.getElementById('notificationBellBtn');
    const dropdown = document.getElementById('notificationDropdown');

    if (!container || !bell || !dropdown) return;

    bell.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
        if (!dropdown.classList.contains('hidden') && !dropdown.contains(e.target) && !bell.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
});