<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Loan') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('loans.update', $loan) }}" x-data="{ category: null }" enctype="multipart/form-data" class="p-4 bg-white dark:bg-slate-800 rounded-md">
                @csrf
                @method('PUT')
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                        <select id="category_id" x-model="category" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>Choose a Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $loan->category_id ? 'selected' : '' }}>{{ $category->categoryName }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student/Staff ID</label>
                        <input type="text" id="user_id" name="user_id" value="{{ $loan->user_id }}" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('user_id')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student/Staff name</label>
                        <input type="text" id="username" name="username" value="{{ $loan->username }}" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('username')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Address</label>
                        <input type="text" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('email', $loan->email) }}">
                        @error('email')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="phoneNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                        <input type="text" id="phoneNumber" name="phoneNumber" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('phoneNumber', $loan->phoneNumber) }}">
                        @error('phoneNumber')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="startLoanDate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Date</label>
                        <input type="date" id="startLoanDate" name="startLoanDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('startLoanDate', $loan->startLoanDate) }}" required>
                        @error('startLoanDate')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="estReturnDate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Date</label>
                        <input type="date" id="estReturnDate" name="estReturnDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('estReturnDate', $loan->estReturnDate) }}" required>
                        @error('estReturnDate')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="loanDuration" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Loan Duration (in days)</label>
                        <input type="text" id="loanDuration" name="loanDuration" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly disabled>
                    </div>
                </div>

                    <div>
                        <label for="supervisorName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Person In charge</label>
                        <input type="text" id="supervisorName" name="supervisorName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5                        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('supervisorName', $loan->supervisorName) }}">
                        @error('supervisorName')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="reason" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Purpose of loan</label>
                        <textarea id="reason" name="reason" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ old('reason', $loan->reason) }}</textarea>
                        @error('reason')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
    <div class="col-md-6 form-check">
        <div class="form-check form-check-inline">
            <input type="checkbox" id="termsAndCondition" name="termsAndCondition" value="1">
            <label class="form-check-label" for="termsAndCondition">
                I have read and agree to the <a href="{{ route('terms-and-conditions') }}" target="_blank" class="text-blue-500">terms and conditions</a>
            </label>
            @error('termsAndCondition')
            <div class="text-sm text-red-400">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>


                <br>

                <div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Update</button>
                </div>
            </form>
        </div>
    </div>
<script>
    // Add a JavaScript function to validate the date range and calculate the loan duration
        function updateLoanDuration() {
            const startDate = new Date(document.getElementById('startLoanDate').value);
            const estReturnDate = new Date(document.getElementById('estReturnDate').value);
            const loanDurationField = document.getElementById('loanDuration');

            if (isNaN(startDate) || isNaN(estReturnDate)) {
                loanDurationField.value = '';
                return;
            }

            const timeDiff = estReturnDate - startDate;
            const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

            if (daysDiff < 0 || daysDiff > 30) {
                loanDurationField.value = 'Invalid Date Range';
                document.getElementById('estReturnDate').value = ''; // Clear invalid date
            } else {
                loanDurationField.value = daysDiff;
            }
        }

              // Attach the updateLoanDuration function to both date inputs' change events
              document.getElementById('startLoanDate').addEventListener('change', updateLoanDuration);
        document.getElementById('estReturnDate').addEventListener('change', updateLoanDuration);

        // Call the function initially to calculate loan duration if dates are pre-filled
        updateLoanDuration();
    </script>
</x-app-layout>



