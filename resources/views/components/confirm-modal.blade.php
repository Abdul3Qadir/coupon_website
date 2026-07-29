<div id="confirmModal" class="fixed inset-0 z-50 hidden items-center justify-center px-4">
    <div class="confirm-modal-backdrop absolute inset-0 bg-gray-900/50"></div>
    <div class="relative w-full max-w-sm rounded-2xl bg-white p-6 shadow-xl">
        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-50">
            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 9v4M12 17h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
        </div>
        <h2 id="confirmModalTitle" class="mt-4 text-center font-Manrope text-lg font-extrabold text-gray-900"></h2>
        <p id="confirmModalMessage" class="mt-2 text-center font-Inter text-sm text-gray-600"></p>
        <div class="mt-6 flex gap-3">
            <button type="button" id="confirmModalCancel" class="cursor-pointer flex-1 rounded-full bg-gray-100 hover:bg-gray-200 px-4 py-2.5 font-Manrope text-sm font-bold text-gray-800 transition">Cancel</button>
            <button type="button" id="confirmModalConfirm" class="cursor-pointer flex-1 rounded-full bg-red-600 hover:bg-red-700 px-4 py-2.5 font-Manrope text-sm font-bold text-white transition"></button>
        </div>
    </div>
</div>
