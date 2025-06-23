<x-layouts.auth :title="__('Terms of Service')">
    <div
        class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="p-6">
            <h1 class="text-2xl font-bold">Terms of Service</h1>

            <p class="text-gray-600 dark:text-gray-400 mt-1">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aperiam commodi culpa cum doloribus, illum
                in
                iure iusto, numquam odio quam quibusdam quo repellendus sit, velit. Harum minima nobis recusandae?
            </p>


            @if ($errors->any())
                <div class="mt-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('terms.store') }}" method="POST">
                @csrf
                <div class="mt-4">
                    <x-forms.checkbox name="accept_terms" id="accept_terms" label="I accept the terms of service"
                        value="1" required />
                </div>

                <div class="mt-4">
                    <x-button class="w-full">{{ __('Accept') }}</x-button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.auth>