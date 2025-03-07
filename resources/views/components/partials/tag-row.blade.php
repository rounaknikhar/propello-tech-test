@props([
    'tag' => null,
])

<div class="w-full flex py-2 border-b border-gray-100">
    <div class="w-5/12 flex items-center">{{ $tag?->name }}</div>
    <div class="w-2/12 flex items-center">{{ $tag?->getTagCreator()->name }}</div>
    <div class="w-5/12 flex flex-wrap">
        @if ($tag?->isTagCreator())
            <x-elements.link-button class="mr-2 my-1 w-[110px] disabled" href="{{ route('tags.edit', ['tag' => $tag]) }}">
                Edit
            </x-elements.link-button>
            <x-elements.link-button-danger class="mr-2 my-1 w-[110px]"
                href="{{ route('tags.destroy', ['tag' => $tag]) }}">
                Delete
            </x-elements.link-button-danger>
        @else
            <span class="text-red-300">You don't have permission</span>
        @endif
    </div>
</div>
