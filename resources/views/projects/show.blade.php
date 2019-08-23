@extends ('layouts.app')

@section ('content')
    <header class="flex justify-between items-end mb-3 pb-4">
        <p class="text-grey text-sm font-normal">
            <a href="/projects" class="text-grey text-sm font-normal no-underline">
                My Projects
            </a>
            / {{ $project->title }}
        </p>
        <a href="/projects/create" class="button">Add Project</a>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-lg text-grey font-normal mb-3">Tasks</h2>

                    @foreach ($project->tasks as $task)
                        <div class="card mb-3">
                            <form action="{{ $task->path() }}" method="post">
                                @method('patch')
                                @csrf

                                <div class="flex">
                                    <input
                                        type="text"
                                        name="body"
                                        value="{{ $task->body }}"
                                        class="w-full {{ $task->completed ? 'text-grey' : '' }}"
                                    >
                                    <input
                                        type="checkbox"
                                        name="completed"
                                        onchange="this.form.submit()"
                                        {{ $task->completed ? 'checked' : '' }}
                                    >
                                </div>
                            </form>
                        </div>
                    @endforeach

                    <div class="card mb-">
                        <form action="{{ $project->path() . '/tasks' }}" method="post">
                            @csrf
                            <input type="text" name="body" placeholder="Add a new task…" class="w-full">
                        </form>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg text-grey font-normal mb-3">General Notes</h2>
                    <form action="{{ $project->path() }}" method="post">
                        @method('patch')
                        @csrf

                        <textarea
                            name="notes"
                            class="card w-full mb-4"
                            style="min-height: 200px;"
                            placeholder="Anything special that you want to make a note of?"
                        >{{ $project->notes }}</textarea>
                        <button type="submit" class="button">Save</button>
                    </form>
                </div>
            </div>
            <div class="lg:w-1/4 px-3 lg:py-8">
                @include ('projects.card')
            </div>
        </div>
    </main>
@endsection
