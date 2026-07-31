@props(['brand'])
<div id="rejectBrandModal" class="fixed inset-0 z-50 hidden items-center justify-center px-4">
    <div id="rejectBrandBackdrop" class="absolute inset-0 bg-gray-900/50"></div>
    <div class="relative w-full max-w-md rounded-2xl bg-white p-6 shadow-xl">
        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-50">
            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </div>
        <h2 class="mt-4 text-center font-Manrope text-lg font-extrabold text-gray-900">Reject this brand?</h2>
        <p class="mt-2 text-center font-Inter text-sm text-gray-600">Tell {{ $brand->name }} why their registration wasn't approved.</p>

        <form method="POST" action="{{ route('admin.brands.reject', $brand) }}" class="mt-5">
            @csrf
            <textarea name="rejection_reason" rows="3" required maxlength="500" placeholder="e.g. Website could not be verified, please provide a valid business URL." class="w-full rounded-lg border border-gray-200 px-3 py-2.5 font-Inter text-sm text-gray-900 placeholder:text-gray-400 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition"></textarea>

            <div class="mt-5 flex gap-3">
                <button type="button" id="rejectBrandCancel" class="cursor-pointer flex-1 rounded-full bg-gray-100 hover:bg-gray-200 px-4 py-2.5 font-Manrope text-sm font-bold text-gray-800 transition">Cancel</button>
                <button type="submit" class="cursor-pointer flex-1 rounded-full bg-red-600 hover:bg-red-700 px-4 py-2.5 font-Manrope text-sm font-bold text-white transition">Yes, Reject</button>
            </div>
        </form>
    </div>
</div>
