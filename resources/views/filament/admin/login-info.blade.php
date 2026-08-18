<div class="mb-6 space-y-4">
    <x-filament::section icon="heroicon-o-key" icon-color="info">
        <x-slot name="heading">Acceso de prueba</x-slot>

        <dl class="space-y-2 text-sm">
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Email</dt>
                <dd class="font-semibold break-all text-gray-950 dark:text-white">administrador@legajocreater.com</dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Contraseña</dt>
                <dd class="font-semibold text-gray-950 dark:text-white">contraseña</dd>
            </div>
        </dl>
    </x-filament::section>

    <x-filament::section icon="heroicon-o-user-plus" icon-color="success">
        <x-slot name="heading">Crear un colegiado nuevo</x-slot>

        <p class="text-sm text-gray-700 dark:text-gray-300">
            Completá el formulario y, en <span class="font-medium">Laboratorio</span>, poné una de estas opciones:
            Oro lab, Travaglino o Moragrega.
        </p>

        <a
            href="https://n8n.ejservicios.online/form/399a874d-e6b2-4e4c-8d85-27097a74d74e"
            target="_blank"
            rel="noopener"
            class="mt-3 inline-flex items-center gap-x-1.5 text-sm font-medium text-success-600 hover:text-success-500 dark:text-success-400"
        >
            <x-filament::icon icon="heroicon-o-arrow-top-right-on-square" class="h-4 w-4" />
            Abrir formulario de alta de colegiado
        </a>
    </x-filament::section>

    <x-filament::section icon="heroicon-o-arrow-right-on-rectangle" icon-color="primary">
        <x-slot name="heading">Ingresar como colegiado</x-slot>

        <p class="text-sm text-gray-700 dark:text-gray-300">
            Los colegiados cargan su matrícula, SSS y habilitación de laboratorio desde su propio panel.
        </p>

        <a
            href="{{ route('filament.panel.auth.login') }}"
            class="mt-3 inline-flex items-center gap-x-1.5 text-sm font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400"
        >
            <x-filament::icon icon="heroicon-o-arrow-top-right-on-square" class="h-4 w-4" />
            Ir al login de colegiados (/panel)
        </a>
    </x-filament::section>
</div>
