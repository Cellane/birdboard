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
                    <div class="card mb-3">Lorem ipsum.</div>
                    <div class="card mb-3">Lorem ipsum.</div>
                    <div class="card mb-3">Lorem ipsum.</div>
                    <div class="card">Lorem ipsum.</div>
                </div>

                <div>
                    <h2 class="text-lg text-grey font-normal mb-3">General Notes</h2>
                    <textarea class="card w-full" style="min-height: 200px;">Lorem ipsum.</textarea>
                </div>
            </div>
            <div class="lg:w-1/4 px-3">
                @include ('projects.card')
            </div>
        </div>
    </main>
@endsection
