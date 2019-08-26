@extends ('layouts.app')

@section ('content')
    <header class="flex justify-between items-end mb-3 pb-4">
        <h2 class="text-muted text-base font-light">My Projects</h2>
        <a
            href="/projects/create"
            class="button"
            @click.prevent="$modal.show('new-project')"
        >Add Project</a>
    </header>

    <main class="lg:flex lg:flex-wrap -mx-3">
        @forelse ($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                @include ('projects.card')
            </div>
        @empty
            <div>No projects yet.</div>
        @endforelse
    </main>

    <new-project-modal></new-project-modal>
@endsection
