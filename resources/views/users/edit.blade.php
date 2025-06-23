<x-layouts.app>
    <div
        class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">
        <div class="p-6">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-6">
                        <h3
                            class="text-lg font-medium text-gray-800 dark:text-gray-200 border-b border-gray-200 dark:border-gray-700 pb-2">
                            Edit User</h3>

                        <div>
                            <x-forms.input label="First Name" name="first_name" placeholder="Enter first name"
                                :value="$user->first_name" />
                        </div>
                        <div>
                            <x-forms.input label="Last Name" name="last_name" placeholder="Enter last name"
                                :value="$user->last_name" />
                        </div>
                        <div>
                            <x-forms.input label="Email" name="email" placeholder="Enter email" :value="$user->email" />
                        </div>
                        <div>
                            <x-forms.input label="Address" name="address" placeholder="Enter address"
                                :value="$user->address" />
                        </div>
                        <div>
                            <x-forms.input label="Phone Number" name="phone_number" placeholder="Enter phone number"
                                :value="$user->phone_number" />
                        </div>
                        <div>
                            <x-forms.select label="Role" name="role" :options="$roles" optionKey="name"
                                :value="$user->roles->pluck('name')->implode(', ')" />
                        </div>
                        <div>
                            <x-forms.checkbox label="Terms Accepted" name="terms_accepted" value="1" class="mt-"
                                :checked="$user->terms_accepted_at ? true : false" />
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-8 pt-5 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('users.index') }}"
                            class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <x-button type="primary" tag="button" buttonType="submit">
                            Update User
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>