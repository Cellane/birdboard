@extends ('layouts.app')

@section ('content')
    <div class="lg:w-1/2 lg:mx-auto bg-white py-12 px-16 rounded shadow">
        <h1 class="text-2xl font-normal mb-10 text-center">Edit Your Project</h1>

        <form action="{{ $project->path() }}" method="post">
            @method ('patch')
            @include ('projects.form', ['buttonText' => 'Update Project'])
        </form>
    </div>
@endsection
