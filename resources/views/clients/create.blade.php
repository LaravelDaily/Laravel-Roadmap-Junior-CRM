<x-layouts.app>
    <div
        class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">
        <div class="p-6">
            <form action="{{ route('clients.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-6 col-span-2">
                        <h3
                            class="text-lg font-medium text-gray-800 dark:text-gray-200 border-b border-gray-200 dark:border-gray-700 pb-2">
                            Create Client</h3>
                    </div>

                    <div>
                        <x-forms.input label="Contact Name" name="contact_name" placeholder="Enter contact name" />
                    </div>
                    <div>
                        <x-forms.input label="Contact Email" name="contact_email" placeholder="Enter contact email" />
                    </div>
                    <div>
                        <x-forms.input label="Contact Phone Number" name="contact_phone_number"
                            placeholder="Enter contact phone number" />
                    </div>
                    <div>
                        <x-forms.input label="Company Name" name="company_name" placeholder="Enter company name" />
                    </div>
                    <div>
                        <x-forms.input label="Company Address" name="company_address"
                            placeholder="Enter company address" />
                    </div>
                    <div>
                        <x-forms.input label="Company City" name="company_city" placeholder="Enter company city" />
                    </div>
                    <div>
                        <x-forms.input label="Company Zip" name="company_zip" placeholder="Enter company zip" />
                    </div>
                    <div>
                        <x-forms.input label="Company VAT" name="company_vat" placeholder="Enter company vat" />
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-8 pt-5 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('clients.index') }}"
                            class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <x-button type="primary" tag="button" buttonType="submit">
                            Create Client
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>