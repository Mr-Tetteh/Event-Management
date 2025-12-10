<section class="py-8 px-4">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left: Form -->
            <div class="lg:col-span-5 w-full">
                <form class="bg-white rounded-xl shadow-lg" wire:submit.prevent="{{ $Edit ? 'update' : 'create' }}">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-t-xl p-6">
                        <h2 class="text-2xl font-bold text-white">Funeral Donations</h2>
                    </div>

                    <div class="p-8 space-y-6">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Donor Details</h3>

                        <!-- Name -->
                        <div>
                            <label class="text-sm font-medium text-gray-700 mb-2 block">
                                Name <span class="text-red-500">*</span>
                            </label>
                            <input wire:model="donor_name" type="text" placeholder="Enter Beneficiary Full Name"
                                class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 bg-gray-50 hover:bg-white transition">
                            @error('donor_name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>

                        <!-- Contact -->
                        <div>
                            <label class="text-sm font-medium text-gray-700 mb-2 block">
                                Contact <span class="text-red-500">*</span>
                            </label>
                            <input wire:model="phone" type="tel" inputmode="tel" pattern="[0-9+\s()-]*" placeholder="Enter Contact"
                
                                class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 bg-gray-50 hover:bg-white transition">
                                 @error('phone')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                            </div>

                        <!-- Amount -->
                        <div>
                            <label class="text-sm font-medium text-gray-700 mb-2 block">Amount</label>
                            <input wire:model="amount" type="number" step="0.01" placeholder="Enter Amount"
                                class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 bg-gray-50 hover:bg-white transition">
                            @error('amount')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>

                        <!-- Beneficiary -->
                        <div>
                            <label class="text-sm font-medium text-gray-700 mb-2 block">Beneficiary</label>
                            <select wire:model="beneficiary_id"
                                class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 bg-gray-50 hover:bg-white transition">
                                <option value="">Select Beneficiary</option>
                                @foreach($beneficiaries as $beneficiary)
                                    <option value="{{ $beneficiary->id }}">{{ $beneficiary->full_name }}</option>
                                @endforeach
                            </select>
                            @error('beneficiary_id')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition flex items-center justify-center gap-2">
                            {{ $Edit ? 'Update Beneficiary Details' : 'Upload Beneficiary Details' }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right: Table -->
            <div class="lg:col-span-7 w-full overflow-x-auto">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="text-xl font-semibold text-gray-800 mb-6">Uploaded Beneficiaries</div>
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Donor Name</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Contact</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Amount</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Beneficiary</th>
                                @if (auth()->user()->role === 'superAdmin')
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Action</th>
                                 @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($datas as $data)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $data->donor_name }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $data->phone ?? 'N/A' }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $data->amount }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900"> {{ $data->beneficiary->full_name ?? 'N/A' }}</td>
                                @if (auth()->user()->role === 'superAdmin')
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <button wire:click="edit({{ $data->id }})" class="px-3 py-1.5 bg-amber-100 text-amber-700 rounded-lg hover:bg-amber-200">Edit</button>
                                        <button wire:click="delete({{ $data->id }})" class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Delete</button>
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $datas->links() }}
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


