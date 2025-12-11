<div class="w-full overflow-x-auto bg-gray-50 rounded-2xl p-7">
    <div class="">

        <div class="text-xl font-semibold text-black mb-6">
            User Management
        </div>
       
            <div class="mb-8 border-b pb-4">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-black">Full Name</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-black">Contact</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-black">Email</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-black">Role</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-black">Created At</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-black">Actions At</th>

                        </tr>
                    </thead>

                    <tbody">
                         @foreach($datas as $data)                      
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-black">{{ $data->first_name }} {{ $data->last_name }}</td>
                                <td class="px-6 py-4 text-black"> <a href="tel::{{ $data->contact }}">{{  $data->contact }}</a></td>
                                <td class="px-6 py-4 text-black">{{ $data->contact }}</td>
                                <td class="px-6 py-4 text-black">{{ $data->role }}</td>
                                <td class="px-6 py-4 text-black">{{ $data->created_at->diffForHumans() }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <button wire:click="edit({{ $data->id }})"  class="px-3 py-1.5 bg-amber-100 text-amber-700 rounded-lg hover:bg-amber-200">Edit</button>
                                        {{-- <button command="show-modal" commandfor="dialog"  class="rounded-md bg-white/10 px-2.5 py-1.5 text-sm font-semibold text-white inset-ring inset-ring-white/5 hover:bg-white/20">Open dialog</button> --}}

                                        <button wire:click="delete({{ $data->id }})" class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
          
            </div>

        <div class="mt-6 text-xl font-bold text-gray-900">
             Number of Users: {{ $users }}
        </div>

    </div>

    @if ($Edit)
        
  <div  aria-labelledby="dialog-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
    <el-dialog-backdrop class="fixed inset-0 bg-gray-900/50 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

    <div tabindex="0" class="flex min-h-full items-end justify-center p-4 text-center focus:outline-none sm:items-center sm:p-0">
      <el-dialog-panel class="relative transform overflow-hidden rounded-lg bg-gray-800 text-left shadow-xl outline -outline-offset-1 outline-white/10 transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-lg data-closed:sm:translate-y-0 data-closed:sm:scale-95">
        <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div>           
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h1 class="text-2xl">User Management</h1>
              <div class="mt-2">
      <form class="p-1 " wire:submit.prevent="update">

    <div class="mt-4 space-y-6">
        <!-- First Name -->
        <div>
            <label class="text-sm font-medium text-gray-300 mb-2 block">First Name</label>
            <input wire:model="first_name" type="text" disabled
                class="w-full px-4 py-3 rounded-lg border border-gray-600 bg-gray-700 text-white 
                focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 hover:bg-gray-600 transition">
            @error('first_name')<span class="text-red-400 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Last Name -->
        <div>
            <label class="text-sm font-medium text-gray-300 mb-2 block">Last Name</label>
            <input wire:model="last_name" type="text" disabled
                class="w-full px-4 py-3 rounded-lg border border-gray-600 bg-gray-700 text-white 
                focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 hover:bg-gray-600 transition">
            @error('last_name')<span class="text-red-400 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Contact -->
        <div>
            <label class="text-sm font-medium text-gray-300 mb-2 block">Contact</label>
            <input wire:model="contact" type="tel" disabled
                class="w-full px-4 py-3 rounded-lg border border-gray-600 bg-gray-700 text-white 
                focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 hover:bg-gray-600 transition">
            @error('contact')<span class="text-red-400 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Email -->
        <div>
            <label class="text-sm font-medium text-gray-300 mb-2 block">Email</label>
            <input wire:model="email" type="email" disabled
                class="w-full px-4 py-3 rounded-lg border border-gray-600 bg-gray-700 text-white 
                focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 hover:bg-gray-600 transition">
            @error('email')<span class="text-red-400 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Role -->
        <div>
            <label class="text-sm font-medium text-gray-300 mb-2 block">Role</label>
            <select wire:model="role"
                class="w-full px-4 py-3 rounded-lg border border-gray-600 bg-gray-700 text-white 
                focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 hover:bg-gray-600 transition">
                <option value="">Select Option</option>
                <option value="Abusuapanyin">Abusuapanyin</option>
                <option value="Abusua Krakyi">Abusua Krakyi</option>
                <option value="Admin">Admin</option>
                <option value="User">User</option>
            </select>
            @error('role')<span class="text-red-400 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
            Update User
        </button>
    </div>

</form>


                         </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-700/25 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
          <button type="button" command="close" commandfor="dialog" class="mt-3 inline-flex w-full justify-center rounded-md bg-white/10 px-3 py-2 text-sm font-semibold text-white inset-ring inset-ring-white/5 hover:bg-white/20 sm:mt-0 sm:w-auto" wire:click="closeModal">Cancel</button>
        </div>
      </el-dialog-panel>
    </div>
  </div>
 @endif


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
</div>
