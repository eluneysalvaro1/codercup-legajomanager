<x-filament-panels::page>
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        {{-- Matrícula --}}
        <x-filament::section icon="heroicon-o-identification" icon-color="primary" class="legajo-card border-primary-500">
            <x-slot name="heading">Matrícula</x-slot>

            @if ($matricula = $this->getMatricula())
                <dl class="grid grid-cols-2 gap-x-4 gap-y-3">
                    <div class="col-span-2 sm:col-span-1">
                        <dt class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Expedición</dt>
                        <dd class="text-sm font-semibold text-gray-950 dark:text-white">{{ $matricula->fecha_expedicion->format('d/m/Y') }}</dd>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <dt class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Vencimiento</dt>
                        <dd class="text-sm font-semibold text-gray-950 dark:text-white">{{ $matricula->fecha_vencimiento->format('d/m/Y') }}</dd>
                    </div>
                </dl>

                <a href="{{ route('descargas.matriculas', $matricula) }}" target="_blank" rel="noopener"
                    class="mt-3 inline-flex items-center gap-x-1.5 text-sm font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400">
                    <x-filament::icon icon="heroicon-o-arrow-down-tray" class="h-4 w-4" />
                    Ver / descargar archivo
                </a>
            @else
                <p class="text-sm text-gray-500 dark:text-gray-400">Todavía no cargaste tu matrícula.</p>
            @endif

            <div class="mt-4">
                {{ $this->matriculaAction }}
            </div>
        </x-filament::section>

        {{-- SSS --}}
        <x-filament::section icon="heroicon-o-shield-check" icon-color="warning" class="legajo-card border-warning-500">
            <x-slot name="heading">SSS</x-slot>

            @if ($sss = $this->getSss())
                <dl class="grid grid-cols-2 gap-x-4 gap-y-3">
                    <div class="col-span-2">
                        <dt class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Número de inscripción</dt>
                        <dd class="text-sm font-semibold text-gray-950 dark:text-white">{{ $sss->numero_inscripcion }}</dd>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <dt class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Expedición</dt>
                        <dd class="text-sm font-semibold text-gray-950 dark:text-white">{{ $sss->fecha_expedicion->format('d/m/Y') }}</dd>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <dt class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Vencimiento</dt>
                        <dd class="text-sm font-semibold text-gray-950 dark:text-white">{{ $sss->fecha_vencimiento->format('d/m/Y') }}</dd>
                    </div>
                </dl>

                <a href="{{ route('descargas.sss', $sss) }}" target="_blank" rel="noopener"
                    class="mt-3 inline-flex items-center gap-x-1.5 text-sm font-medium text-warning-600 hover:text-warning-500 dark:text-warning-400">
                    <x-filament::icon icon="heroicon-o-arrow-down-tray" class="h-4 w-4" />
                    Ver / descargar archivo
                </a>
            @else
                <p class="text-sm text-gray-500 dark:text-gray-400">Todavía no cargaste tu SSS.</p>
            @endif

            <div class="mt-4">
                {{ $this->sssAction }}
            </div>
        </x-filament::section>

        {{-- Habilitación de laboratorio --}}
        <x-filament::section icon="heroicon-o-beaker" icon-color="success" class="legajo-card border-success-500">
            <x-slot name="heading">Habilitación de laboratorio</x-slot>

            @if ($habilitacion = $this->getHabilitacionLaboratorio())
                <dl class="grid grid-cols-2 gap-x-4 gap-y-3">
                    <div class="col-span-2 sm:col-span-1">
                        <dt class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Expedición</dt>
                        <dd class="text-sm font-semibold text-gray-950 dark:text-white">{{ $habilitacion->fecha_expedicion->format('d/m/Y') }}</dd>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <dt class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Vencimiento</dt>
                        <dd class="text-sm font-semibold text-gray-950 dark:text-white">{{ $habilitacion->fecha_vencimiento->format('d/m/Y') }}</dd>
                    </div>
                </dl>

                <a href="{{ route('descargas.habilitaciones', $habilitacion) }}" target="_blank" rel="noopener"
                    class="mt-3 inline-flex items-center gap-x-1.5 text-sm font-medium text-success-600 hover:text-success-500 dark:text-success-400">
                    <x-filament::icon icon="heroicon-o-arrow-down-tray" class="h-4 w-4" />
                    Ver / descargar archivo
                </a>
            @else
                <p class="text-sm text-gray-500 dark:text-gray-400">Todavía no cargaste tu habilitación de laboratorio.</p>
            @endif

            <div class="mt-4">
                {{ $this->habilitacionAction }}
            </div>
        </x-filament::section>
    </div>
</x-filament-panels::page>
