<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Loans') }}
            </h2>
            <div>
                <a href="{{ route('loans.create') }}" class="dark:text-white hover:text-slate-200">New Loans</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-lg text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Index Number
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Cateogry Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Student/Staff ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Start Loan Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Estimated Return Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($loans as $loan)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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
                            </td>
                            <td class="px-6 py-4">
                                {{ $loan->estReturnDate }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    @if(auth()->user()->isAdmin()) 
                                        <a href="{{ route('loans.edit', $loan) }}" class="text-green-400 hover:text-green-600">Edit</a>

                                        <form method="POST" class="text-red-400 hover:text-red-600" action="{{ route('loans.destroy', $loan) }}">
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
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                No Loans found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>