<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Terms and Conditions') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-semibold mb-4">Welcome to Our Website</h1>

                <p>
                    These terms and conditions outline the rules and regulations for the use of our website.
                    By accessing this website, we assume you accept these terms and conditions in full.
                    Do not continue to use our website if you do not accept all of the terms and conditions stated on this page.
                </p>

                <h2 class="text-lg font-semibold mt-4">Cookies</h2>
                <p>
                    We employ the use of cookies. By using our website, you consent to the use of cookies in accordance with our privacy policy.
                </p>

                <h2 class="text-lg font-semibold mt-4">License</h2>
                <p>
                    Unless otherwise stated, we and/or our licensors own the intellectual property rights for all material on our website.
                    All intellectual property rights are reserved. You may view and/or print pages from the website for your own personal use,
                    subject to restrictions set in these terms and conditions.
                </p>

                <h2 class="text-lg font-semibold mt-4">Restrictions</h2>
                <p>You are specifically restricted from all of the following:</p>
                <ul class="list-disc pl-6">
                    <li>Publishing any website material in any other media.</li>
                    <li>Selling, sublicensing, and/or otherwise commercializing any website material.</li>
                    <li>Publicly performing and/or showing any website material.</li>
                    <li>Using this website in any way that is or may be damaging to this website.</li>
                </ul>

                <h2 class="text-lg font-semibold mt-4">Updates</h2>
                <p>
                    We may revise these terms and conditions from time to time. Revised terms and conditions will apply to the use of this website
                    from the date of publication of the revised terms and conditions on this website. Please check this page regularly to ensure
                    you are familiar with the current version.
                </p>

                <p class="mt-6">
                    If you have any questions about these terms and conditions, please <a href="{{ route('contact') }}" target="_blank" class="text-blue-500">contact us</a>.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
