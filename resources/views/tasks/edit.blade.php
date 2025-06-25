<x-layouts.app>
    <div
        class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">
        <div class="p-6">
            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-6 col-span-2">
                        <h3
                            class="text-lg font-medium text-gray-800 dark:text-gray-200 border-b border-gray-200 dark:border-gray-700 pb-2">
                            Edit Task</h3>
                    </div>

                    <div>
                        <x-forms.input label="Title" name="title" placeholder="Enter title" :value="$task->title" />
                    </div>
                    <div>
                        <x-forms.input label="Description" name="description" placeholder="Enter description"
                            :value="$task->description" />
                    </div>
                    <div>
                        <x-forms.select label="Client" name="client_id" placeholder="Enter client"
                            :options="$clients" :optionKey="'id'" :optionValue="'company_name'" :value="$task->client_id" />
                    </div>
                    <div>
                        <x-forms.select label="Project" name="project_id" placeholder="Enter project"
                            :options="$projects" :optionKey="'id'" :optionValue="'title'" :value="$task->project_id" />
                    </div>
                    <div>
                        <x-forms.select label="User" name="user_id" placeholder="Enter user" :options="$users"
                            :optionKey="'id'" :optionValue="'full_name'" :value="$task->user_id" />
                    </div>
                    <div>
                        <x-forms.input type="date" label="Deadline" name="deadline" placeholder="Enter deadline"
                            :value="$task->deadline->format('Y-m-d')" />
                    </div>
                    <div>
                        <x-forms.select label="Status" name="status" placeholder="Enter status" :options="$statuses"
                            :optionKey="'value'" :optionValue="'name'" :value="$task->status" />
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-8 pt-5 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('tasks.index') }}"
                            class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <x-button type="primary" tag="button" buttonType="submit">
                            Update Task
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-6">
        <div
            class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-6">
                <h3
                    class="text-lg font-medium text-gray-800 dark:text-gray-200 border-b border-gray-200 dark:border-gray-700 pb-2 mb-6">
                    Files
                </h3>
    
                <form action="{{ route('media.upload', ['Task', $task]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <x-forms.input type="file" label="File" name="file" id="file" />
                    </div>
                    <x-button type="primary" tag="button" buttonType="submit">
                        Upload
                    </x-button>
                </form>
    
                @if($task->getMedia()->count() > 0)
                    <div class="mt-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            File name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Size
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($task->getMedia() as $media)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ $media->file_name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {{ $media->human_readable_size }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                                <a href="{{ route('media.download', $media) }}"
                                                    class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300">
                                                    Download
                                                </a>
                                                <form action="{{ route('media.delete', ['Task', $task, $media]) }}"
                                                    method="POST" onsubmit="return confirm('Are you sure?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="mt-6 text-center py-8">
                        <p class="text-gray-500 dark:text-gray-400">No files uploaded yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>