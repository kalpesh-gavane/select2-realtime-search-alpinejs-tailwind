<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tags Input - Tailwind 3 + Alpine.js</title>
    <!-- Tailwind CSS 3 CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-lg p-6 rounded-lg bg-white shadow" 
        x-data="{
            isOpen: false,
            selectedTags: [],
            options: [],
            tags: [],
            searchQuery: '',
            isLoading: false,
            minSearchLength: 2,
            async fetchOptions(searchTerm = '') {
                if (searchTerm.length < this.minSearchLength) {
                    this.options = [];
                    return;
                }
                this.isLoading = true;
                try {
                    const response = await fetch(`your-backend-endpoint/${term}`.replace('term', encodeURIComponent(searchTerm)));
                    this.options = await response.json();
                } catch (error) {
                    this.options = [];
                } finally {
                    this.isLoading = false;
                }
            },
            toggle() {
                this.isOpen = !this.isOpen;
                if (this.isOpen && this.searchQuery.length >= this.minSearchLength) {
                    this.fetchOptions(this.searchQuery);
                }
            },
            select(option) {
                if (!this.selectedTags.some(item => item.value === option.value)) {
                    this.selectedTags.push(option);
                    this.tags.push(option.value);
                }
                this.searchQuery = '';
                this.options = [];
                this.isOpen = false;
            },
            removeSelected(index) {
                this.selectedTags.splice(index, 1);
                this.tags.splice(index, 1);
            },
            clearAll() {
                this.selectedTags = [];
                this.tags = [];
            },
            handleSearchInput() {
                if (this.searchQuery.length >= this.minSearchLength) {
                    this.fetchOptions(this.searchQuery);
                    this.isOpen = true;
                } else {
                    this.options = [];
                    this.isOpen = false;
                }
            }
        }"
        @keydown.escape.window="isOpen = false"
    >

        <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">
            Tags 
            <span class="text-red-600">*</span>
        </label>

        <div class="relative">
            <div @click="toggle()" class="flex flex-wrap items-center gap-2 border rounded-md px-3 py-2 focus-within:ring-2 focus-within:ring-blue-500 transition duration-150 cursor-text bg-white min-h-[44px]">
                <template x-for="(item, index) in selectedTags" :key="item.value">
                    <div class="flex items-center bg-blue-100 text-blue-800 rounded px-2 py-1 text-xs font-medium m-0.5">
                        <span x-text="item.label"></span>
                        <button type="button" @click.stop="removeSelected(index)" class="ml-1 text-blue-500 hover:text-blue-700 focus:outline-none">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </template>
                <input
                    x-ref="searchInput"
                    x-model="searchQuery"
                    @input.debounce.300ms="handleSearchInput"
                    @focus="isOpen = true"
                    type="text"
                    placeholder="Type to search tags..."
                    class="appearance-none bg-transparent flex-1 min-w-[120px] text-sm focus:outline-none text-gray-700 placeholder-gray-400"
                    autocomplete="off"
                >
            </div>

            <!-- Clear All Button -->
            <button
                x-show="selectedTags.length > 0"
                @click="clearAll()"
                type="button"
                class="absolute right-12 top-1/2 transform -translate-y-1/2 text-red-500 hover:text-red-700 transition"
                title="Clear all">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Dropdown Toggle Button -->
            <button
                @click="toggle()"
                type="button"
                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-700 focus:outline-none"
                tabindex="-1"
            >
                <svg class="h-5 w-5 transition-transform duration-200" :class="{ 'rotate-180': isOpen }" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd">
                    </path>
                </svg>
            </button>

            <!-- Dropdown -->
            <div
                x-show="isOpen"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                @click.away="isOpen = false"
                class="absolute z-10 mt-1 w-full bg-white shadow-lg rounded-md max-h-56 overflow-auto ring-1 ring-black ring-opacity-5"
                style="display: none;"
            >
                <div x-show="isLoading" class="px-4 py-2 text-sm text-gray-500">
                    Searching...
                </div>
                <div x-show="!isLoading && options.length === 0 && searchQuery.length >= minSearchLength"
                    class="px-4 py-2 text-sm text-gray-500">
                    No results found for "<span x-text="searchQuery"></span>"
                </div>
                <div x-show="!isLoading && searchQuery.length < minSearchLength"
                    class="px-4 py-2 text-sm text-gray-500">
                    Type at least <span x-text="minSearchLength"></span> characters to search
                </div>
                <template x-for="option in options" :key="option.value">
                    <button
                        type="button"
                        @click="select(option)"
                        :disabled="selectedTags.some(item => item.value === option.value)"
                        class="w-full text-left px-4 py-2 hover:bg-blue-50 focus:bg-blue-100 rounded transition flex items-center justify-between text-sm
                                disabled:opacity-50 disabled:cursor-not-allowed"
                        :class="selectedTags.some(item => item.value === option.value) ? 'bg-blue-100 text-blue-600' : ''"
                    >
                        <span x-text="option.label"></span>
                        <svg x-show="selectedTags.some(item => item.value === option.value)"
                            class="h-4 w-4 text-blue-600 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </template>
            </div>

            <!-- Validation Message -->
            <small x-show="tags.length === 0" class="block text-xs text-red-500 mt-1 ml-1">Tags are required</small>
        </div>
    </div>

</body>
</html>
