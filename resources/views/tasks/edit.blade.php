@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <form method="POST" action="{{ route('tasks.update', ['task' => $task]) }}">
                {{-- TASK 1 : Fix update task functionality --}}

                {{-- Remove static CSRF --}}
                {{-- <input type="hidden" name="_token" autocomplete="off" value="JbXMTGEI0EuV90PVZPeEm8eC7r45wmQxUQVLG5B2"> --}}

                {{-- Add dynamic CSRF --}}
                @csrf

                <div class="pb-4">
                    <x-forms.input-label for="name" :value="__('Name')" />
                    <x-forms.text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$task->name"
                        required autofocus />
                    <x-forms.input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <x-elements.primary-button>
                    Update
                </x-elements.primary-button>
            </form>
        </div>

        <div class="mx-5 my-4">
            <h2 class="text-xl mb-4">Tags</h2>
            @foreach ($task->tags()->get() as $tag)
                <div class="mr-1 inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-md font-medium text-gray-600 ring-1 ring-gray-500/10 ring-inset">
                    <span class="pr-4">
                        {{$tag->name}}
                    </span>
                    <a class="p-2 cursor-pointer hover:text-red-400 border-l"
                        href="{{ route('tasks.remove.tag', ['task' => $task, 'tag' => $tag]) }}">
                        X
                    </a>
                </div>
            @endforeach
        </div>
        <x-table.attach-task-tag :task="$task" :tags="$tags" />
    </div>
@endsection
