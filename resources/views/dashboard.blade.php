<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="margin-bottom: 20px">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-gray-900 font-bold text-xl">Biographie</h1>
                    <p>{{ $user->profile->biography }}</p>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-gray-900 font-bold text-xl">Expériences</h1>
                    @foreach($user->profile->experiences()->orderBy('sort')->get() as $experience)
                    <div class="w-full lg:max-w-full lg:flex">
                        <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                          <div class="mb-8">
                            <div class="text-gray-900 font-bold text-xl mb-2">{{ $experience->jobTitle->name }}</div>
                            <p class="text-gray-700 text-base">{{ $experience->description }}</p>
                          </div>
                          <div class="flex items-center">
                            <div class="text-sm">
                                <p class="text-gray-900 leading-none">Entreprise: {{ $experience->company->name }}</p>
                                <p class="text-gray-600">Début: {{ $experience->started_at->format('d/m/Y') }}</p>
                                @if(isset($experience->finished_at))
                                    <p class="text-gray-600">Fin: {{ $experience->finished_at->format('d/m/Y') }}</p>
                                @else
                                <p class="text-gray-600">Emploi actuel</p>
                                @endif
                            </div>
                          </div>
                        </div>
                      </div>

                    @endforeach
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
