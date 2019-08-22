@extends ('layouts.app')

@section ('content')
    <header class="flex justify-between items-end mb-3 py-4">
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
                        <div class="card mb-3">{{ $task->body }}</div>
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
                    <textarea class="card w-full" style="min-height: 200px;">Lorem ipsum.</textarea>
                </div>
            </div>
            <div class="lg:w-1/4 px-3 lg:py-8">
                @include ('projects.card')
            </div>
        </div>
    </main>
@endsection
