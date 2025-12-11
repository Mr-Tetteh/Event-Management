<section class="py-8 px-4">
    <div class="container mx-auto">
        <!-- Flex wrapper -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- Left: Form -->
            <div class="lg:col-span-5">
                <form class="bg-white rounded-xl shadow-lg" wire:submit.prevent="{{ $Edit ? 'update' : 'create' }}">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-t-xl p-6">
                        <h2 class="text-2xl font-bold text-white">Post Beneficiary</h2>
                    </div>

                    <!-- Form Content -->
                    <div class="p-8 space-y-6">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Beneficiary Details</h3>

                        <!-- Full Name -->
                        <div>
                            <label class="text-sm font-medium text-gray-700 mb-2 block">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input
                                wire:model="full_name"
                                type="text"
                                class="w-full px-4 py-3 rounded-lg border border-gray-200 text-black
                                       focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                                       bg-gray-50 hover:bg-white transition"
                                placeholder="Enter Beneficiary Full Name">
                            @error('full_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Contact -->
                        <div>
                            <label class="text-sm font-medium text-gray-700 mb-2 block">
                                Contact 
                            </label>
                            <input
                                wire:model="phone"
                                type="tel"
                                class="w-full px-4 py-3 rounded-lg border border-gray-200 text-black
                                       focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                                       bg-gray-50 hover:bg-white transition"
                                placeholder="Enter Beneficiary contact">
                            @error('phone')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Button -->
                        <button
                            type="submit"
                            class="w-full bg-blue-600 text-white py-3 rounded-lg 
                                   hover:bg-blue-700 transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            {{ $Edit ? 'Update Beneficiary Details' : 'Upload Beneficiary Details' }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right: Table -->
            <div class="lg:col-span-7">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="text-xl font-semibold text-gray-800 mb-6">Uploaded Beneficiaries</div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Beneficiary Name</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Contact</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Action</th>
                            </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                            @foreach($datas as $data)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $data->full_name }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900">  {{ $data->phone ? $data->phone : 'N/A' }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <button wire:click="edit({{ $data->id }})"
                                                class="px-3 py-1.5 bg-amber-100 text-amber-700 rounded-lg hover:bg-amber-200">
                                            Edit
                                        </button>
                                        <button wire:click="delete({{ $data->id }})"
                                                class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <script>
    document.addEventListener('livewire:init', () => {

        Livewire.on('toast', (data) => {
            const message = data.message;

            // Create toast div
            const toast = document.createElement('div');
            toast.className = "fixed top-5 right-5 bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg animate-slide-in";
            toast.innerText = message;

            document.body.appendChild(toast);

            // Remove after 3 seconds
            setTimeout(() => {
                toast.classList.add("animate-slide-out");
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        });

    });
</script>

<!-- Tailwind animations -->
<style>
    @keyframes slide-in {
        from { opacity: 0; transform: translateX(40px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes slide-out {
        from { opacity: 1; transform: translateX(0); }
        to { opacity: 0; transform: translateX(40px); }
    }
    .animate-slide-in {
        animation: slide-in 0.3s ease-out forwards;
    }
    .animate-slide-out {
        animation: slide-out 0.3s ease-in forwards;
    }
</style>

</section>

