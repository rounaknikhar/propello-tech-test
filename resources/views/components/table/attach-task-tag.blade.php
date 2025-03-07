@props([
    'tags' => null,
    'task' => null,
])

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        @if ($tags->isNotEmpty())
            <div class="w-full flex pb-2 border-b border-gray-200">
                <div class="w-5/12 font-semibold">Name</div>
                <div class="w-5/12 font-semibold">Actions</div>
            </div>
        @endif

        @foreach ($tags as $tag)
            <div class="w-full flex py-2 border-b border-gray-100">
                <div class="w-5/12 flex items-center">{{ $tag?->name }}</div>
                <div class="w-5/12 flex flex-wrap">
                    <x-elements.link-button class="mr-2 my-1 w-[110px]"
                        href="{{ route('tasks.add.tag', ['task' => $task, 'tag' => $tag]) }}">
                        Add
                    </x-elements.link-button>
                </div>
            </div>
        @endforeach
    </div>
</div>
