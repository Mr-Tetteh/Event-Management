<div class="lg:col-span-7 w-full overflow-x-auto">
    <div class="bg-white rounded-xl shadow-sm p-6">

        <div class="text-xl font-semibold text-gray-800 mb-6">
            Daily Funeral Donation Summary
        </div>

        @foreach($datas as $date => $records)
            <div class="mb-8 border-b pb-4">

                <div class="text-lg font-bold text-gray-700 mb-2">
                    {{ \Carbon\Carbon::parse($date)->format('l, d M Y') }}
                </div>

                <table class="w-full mb-2">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Donor Name</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Contact</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Amount</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Beneficiary</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Created At</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @foreach($records as $data)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">{{ $data->donor_name }}</td>
                                <td class="px-6 py-4">{{ $data->phone ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $data->amount }}</td>
                                <td class="px-6 py-4">{{ $data->beneficiary->full_name ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $data->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="font-bold text-gray-700">
                    Daily Total: GH₵ {{ number_format($records->sum('amount'), 2) }}
                </div>
            </div>
        @endforeach

        <div class="mt-6 text-xl font-bold text-gray-900">
            Overall Total: GH₵ {{ number_format($totalSum, 2) }}
        </div>

    </div>
</div>
