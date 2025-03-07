@props([
    'task'  => null,
])

<div class="w-full flex py-2 border-b border-gray-100">
    <div class="w-5/12 flex items-center {{ $task?->complete ? 'line-through' : '' }}">{{ $task?->name }}</div>
    <div class="w-5/12 flex items-center">
        @if($task?->tagNames()->isNotEmpty()) 
            @foreach ($task?->tagNames() as $tagName)
                <span class="mr-1 inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-gray-500/10 ring-inset">
                    {{ $tagName }}
                </span>
            @endforeach
        @else 
            Tags not added yet
        @endif
    </div>
    <div class="w-2/12 flex items-center">{{ $task?->created_at->format('jS M Y') }}</div>
    <div class="w-5/12 flex flex-wrap">
        <x-elements.link-button class="mr-2 my-1 w-[110px]" href="{{ route('tasks.complete', ['task' => $task]) }}">
            {{ $task?->complete ? 'Pending' :  'Complete' }}
        </x-elements.link-button>
        <x-elements.link-button class="mr-2 my-1 w-[110px]" href="{{ route('tasks.edit', ['task' => $task]) }}">
            Edit
        </x-elements.link-button>
        <x-elements.link-button-danger class="mr-2 my-1 w-[110px]" href="{{ route('tasks.destroy', ['task' => $task]) }}">
            Delete
        </x-elements.link-button-danger>
    </div>
</div>
