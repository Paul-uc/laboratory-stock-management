<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact Us') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if(session('success'))
                <div class="bg-green-200 text-green-800 p-4 mb-4 rounded-md">
                    {{ session('success') }}
                </div>
                @endif
                <p class="text-lg mb-4">
                    Welcome to the TARUMT Laboratory Loan System. If you have any questions, feedback, or need assistance, please feel free to contact us using the form below.
                </p>
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-900 mb-2">Your Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-900 mb-2">Your Email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required>
                    </div>

                    <div class="mb-4">
                        <label for="message" class="block text-sm font-medium text-gray-900 mb-2">Message</label>
                        <textarea name="message" id="message" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required></textarea>
                    </div>
                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                    <div class="mt-6">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
