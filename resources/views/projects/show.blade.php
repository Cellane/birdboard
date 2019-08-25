@extends ('layouts.app')

@section ('content')
    <header class="flex justify-between items-end mb-6 pb-4">
        <p class="text-muted font-light">
            <a href="/projects" class="text-muted no-underline hover:underline">
                My Projects
            </a>
            / {{ $project->title }}
        </p>

        <div class="flex items-center">
            @foreach ($project->members as $member)
                <img
                    src="{{ gravatar_url($member->email) }}"
                    alt="{{ $member->name }}’s avatar"
                    class="rounded-full w-8 mr-2"
                >
            @endforeach

            <img
                src="{{ gravatar_url($project->owner->email) }}"
                alt="{{ $project->owner->email }}’s avatar"
                class="rounded-full w-8 mr-2"
            >

            <a href="{{ $project->path() . '/edit' }}" class="button ml-4">Edit Project</a>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-lg text-muted font-light mb-3">Tasks</h2>

                    @foreach ($project->tasks as $task)
                        <div class="card mb-3">
                            <form action="{{ $task->path() }}" method="post">
                                @method ('patch')
                                @csrf

                                <div class="flex">
                                    <input
                                        type="text"
                                        name="body"
                                        value="{{ $task->body }}"
                                        class="text-default bg-card w-full {{ $task->completed ? 'line-through text-muted' : '' }}"
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
                            <input type="text" name="body" placeholder="Add a new task…" class="text-default bg-card w-full">
                        </form>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg text-muted font-light mb-3">General Notes</h2>
                    <form action="{{ $project->path() }}" method="post">
                        @method ('patch')
                        @csrf

                        <textarea
                            name="notes"
                            class="card text-default w-full mb-4"
                            style="min-height: 200px;"
                            placeholder="Anything special that you want to make a note of?"
                        >{{ $project->notes }}</textarea>
                        <button type="submit" class="button">Save</button>
                    </form>

                    @include ('errors')
                </div>
            </div>
            <div class="lg:w-1/4 px-3 lg:py-8">
                @include ('projects.card')
                @include ('projects.activity.card')

                @can ('manage', $project)
                    @include ('projects.invite')
                @endcan
            </div>
        </div>
    </main>
@endsection
