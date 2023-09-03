<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Loan Stock Records') }}
            </h2>
            <div>
                <a href="{{ route('loans.create') }}" class="dark:text-white hover:text-slate-200">
                    New Loans
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card Container -->
            <div class="bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg p-6">
                <table class="w-full text-sm table-auto text-gray-600 dark:text-gray-300">
                    <thead class="text-base text-gray-800 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3">Index Number</th>
                            <th class="px-6 py-3">Category Name</th>
                            <th class="px-6 py-3">Student/Staff ID</th>
                            <th class="px-6 py-3">Start Loan Date</th>
                            <th class="px-6 py-3">Estimated Return Date</th>
                            <th class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($loans as $loan)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $loan->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $loan->category->categoryName }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $loan->username }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $loan->startLoanDate }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $loan->estReturnDate }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    @if(auth()->user()->isAdmin())
                                    <a href="{{ route('loans.edit', $loan) }}" class="text-green-500 hover:text-green-700">Edit</a>

                                    <form method="POST" class="text-red-500 hover:text-red-700" action="{{ route('loans.destroy', $loan) }}">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('loans.destroy', $loan) }}" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                            Delete
                                        </a>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                No Loans found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- End Card Container -->
        </div>
    </div>
</x-app-layout>
