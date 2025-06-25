<x-layouts.app>
    <div
        class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">
        <div class="p-6">
            <form action="{{ route('projects.update', $project->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-6 col-span-2">
                        <h3
                            class="text-lg font-medium text-gray-800 dark:text-gray-200 border-b border-gray-200 dark:border-gray-700 pb-2">
                            Edit Project</h3>
                    </div>

                    <div>
                        <x-forms.input label="Title" name="title" placeholder="Enter title"
                            value="{{ $project->title }}" />
                    </div>
                    <div>
                        <x-forms.input label="Description" name="description" placeholder="Enter description"
                            value="{{ $project->description }}" />
                    </div>
                    <div>
                        <x-forms.select label="Client" name="client_id" placeholder="Enter client"
                            :options="$clients" :optionKey="'id'" :optionValue="'company_name'"
                            value="{{ $project->client_id }}" />
                    </div>
                    <div>
                        <x-forms.select label="User" name="user_id" placeholder="Enter user" :options="$users"
                            :optionKey="'id'" :optionValue="'full_name'" value="{{ $project->user_id }}" />
                    </div>
                    <div>
                        <x-forms.input type="date" label="Deadline" name="deadline" placeholder="Enter deadline"
                            value="{{ $project->deadline->format('Y-m-d') }}" />
                    </div>
                    <div>
                        <x-forms.select label="Status" name="status" placeholder="Enter status" :options="$statuses"
                            :optionKey="'value'" :optionValue="'name'" value="{{ $project->status }}" />
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-8 pt-5 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('projects.index') }}"
                            class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <x-button type="primary" tag="button" buttonType="submit">
                            Update Project
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>