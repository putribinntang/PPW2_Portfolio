<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Statistik Project --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <x-stat-card
                    label="Total Projects"
                    :value="$totalProjects"
                    color="text-blue-600"
                />

                <x-stat-card
                    label="Published"
                    :value="$totalPublished"
                    color="text-green-600"
                />

                <x-stat-card
                    label="Draft"
                    :value="$totalDraft"
                    color="text-orange-600"
                />

            </div>

            {{-- Project Terbaru --}}
            <div class="bg-white shadow-sm rounded-lg mt-6 p-6">

                <h3 class="text-lg font-semibold mb-4">
                    Latest Projects
                </h3>

                @forelse ($latestProjects as $project)

                    <div class="border-b py-3">
                        <a href="{{ route('projects.show', $project->id) }}"
                           class="font-medium text-blue-600">
                            {{ $project->title }}
                        </a>

                        <p class="text-sm text-gray-500">
                            {{ ucfirst($project->status) }}
                        </p>
                    </div>

                @empty

                    <p class="text-gray-500">
                        No projects yet.
                    </p>

                @endforelse

            </div>

        </div>
    </div>
</x-app-layout>