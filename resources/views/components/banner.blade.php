@props(['style' => 'success', 'message'])

<div x-data="{{ json_encode(['show' => true, 'style' => $style, 'message' => $message]) }}"
    :class="{ 'bg-gray-900': style == 'success', 'bg-red-700': style == 'danger', 'bg-yellow-500': style == 'warning', 'bg-gray-500': style != 'success' && style != 'danger' && style != 'warning'}"
    x-show="show && message"
    x-init="
        setTimeout(() => {
            show = false
        }, 2000)
    "
    x-transition:enter="transform ease-out duration-300 transition"
    x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
    x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">
    <div class="max-w-screen-xl mx-auto py-2 px-3 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between flex-wrap">
            <div class="w-0 flex-1 flex items-center min-w-0">
                <span class="flex p-2 rounded-lg" :class="{ 'bg-gray-800': style == 'success', 'bg-red-600': style == 'danger', 'bg-yellow-600': style == 'warning' }">
                    <svg x-show="style == 'success'" class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <svg x-show="style == 'danger'" class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9.344-2.998c-.175-.095-.795-.377-2.279-.377-1.037 0-2.136.244-3.207.614-1.071.37-2.142.93-3.207 1.614-1.071-.684-2.142-1.244-3.207-1.614-1.071-.37-2.17-.614-3.207-.614-1.484 0-2.104.282-2.279.377C2.682 10.18 2.25 10.71 2.25 11.285v4.283c0 .575.432 1.104 1.047 1.283.175.095.795.377 2.279.377 1.037 0 2.136-.244 3.207-.614 1.071-.37 2.142-.93 3.207-1.614 1.071.684 2.142 1.244 3.207 1.614 1.071.37 2.17.614 3.207.614 1.484 0 2.104-.282 2.279-.377.615-.179 1.047-.708 1.047-1.283v-4.283c0-.575-.432-1.104-1.047-1.283zM12 17.25v-3" />
                    </svg>
                    <svg x-show="style == 'warning'" class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </span>

                <p class="ms-3 font-medium text-sm text-white truncate" x-text="message"></p>
            </div>

            <div class="shrink-0 sm:ms-3">
                <button
                    type="button"
                    class="-me-1 flex p-2 rounded-md focus:outline-none sm:-me-2 transition"
                    :class="{ 'hover:bg-gray-800 focus:bg-gray-800': style == 'success', 'hover:bg-red-600 focus:bg-red-600': style == 'danger', 'hover:bg-yellow-600 focus:bg-yellow-600': style == 'warning'}"
                    aria-label="Dismiss"
                    x-on:click="show = false">
                    <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
