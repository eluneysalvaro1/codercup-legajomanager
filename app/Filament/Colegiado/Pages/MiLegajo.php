<?php

namespace App\Filament\Colegiado\Pages;

use App\Models\HabilitacionLaboratorio;
use App\Models\Matricula;
use App\Models\Sss;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class MiLegajo extends Page
{
    protected static ?string $slug = 'mis-legajos';

    protected static ?string $navigationLabel = 'Mis legajos';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-folder-open';

    protected static ?string $title = 'Mis legajos';

    protected string $view = 'filament.colegiado.pages.mi-legajo';

    protected const DOCUMENT_MIME_TYPES = ['application/pdf', 'image/jpeg', 'image/png'];

    protected const DOCUMENT_MAX_SIZE_KB = 10240;

    public const COLOR_MATRICULA = 'primary';

    public const COLOR_SSS = 'warning';

    public const COLOR_HABILITACION = 'success';

    public function getMatricula(): ?Matricula
    {
        // Fresh query (not the cached relation) so state is correct right after
        // the upload action creates the record within the same request.
        return $this->user()->matricula()->first();
    }

    public function getSss(): ?Sss
    {
        return $this->user()->sss()->first();
    }

    public function getHabilitacionLaboratorio(): ?HabilitacionLaboratorio
    {
        return $this->user()->habilitacionLaboratorio()->first();
    }

    public function matriculaAction(): Action
    {
        return $this->documentoAction(
            name: 'matricula',
            label: 'la matrícula',
            model: Matricula::class,
            record: $this->getMatricula(),
            color: self::COLOR_MATRICULA,
        );
    }

    public function sssAction(): Action
    {
        return $this->documentoAction(
            name: 'sss',
            label: 'el SSS',
            model: Sss::class,
            record: $this->getSss(),
            color: self::COLOR_SSS,
            extraFields: [
                TextInput::make('numero_inscripcion')
                    ->label('Número de inscripción')
                    ->required()
                    ->maxLength(255),
            ],
        );
    }

    public function habilitacionAction(): Action
    {
        return $this->documentoAction(
            name: 'habilitacion',
            label: 'la habilitación de laboratorio',
            model: HabilitacionLaboratorio::class,
            record: $this->getHabilitacionLaboratorio(),
            color: self::COLOR_HABILITACION,
        );
    }

    /**
     * @param  class-string<Model>  $model
     * @param  array<int, mixed>  $extraFields
     */
    private function documentoAction(string $name, string $label, string $model, ?Model $record, string $color, array $extraFields = []): Action
    {
        return Action::make($name)
            ->label($record ? "Reemplazar {$label}" : "Cargar {$label}")
            ->icon($record ? 'heroicon-o-arrow-path' : 'heroicon-o-arrow-up-tray')
            ->color($color)
            ->outlined((bool) $record)
            ->schema([
                ...$extraFields,
                DatePicker::make('fecha_expedicion')
                    ->label('Fecha de expedición')
                    ->required()
                    ->maxDate(now()),
                FileUpload::make('archivo')
                    ->label('Archivo')
                    ->disk(config('filesystems.legajos_disk'))
                    ->directory(($record ? $record->getTable() : (new $model)->getTable()).'/'.$this->user()->id)
                    ->visibility('private')
                    ->acceptedFileTypes(self::DOCUMENT_MIME_TYPES)
                    ->maxSize(self::DOCUMENT_MAX_SIZE_KB)
                    ->required(),
            ])
            ->action(function (array $data) use ($model, $record): void {
                $user = $this->user();

                Gate::authorize($record ? 'update' : 'create', $record ?? $model);

                $oldArchivoPath = $record?->archivo_path;

                $payload = array_merge($data, [
                    'user_id' => $user->id,
                    'archivo_path' => $data['archivo'],
                ]);
                unset($payload['archivo']);

                if ($record) {
                    $record->update($payload);
                } else {
                    $model::create($payload);
                }

                if ($oldArchivoPath) {
                    Storage::disk(config('filesystems.legajos_disk'))->delete($oldArchivoPath);
                }

                Notification::make()
                    ->title('Documento guardado correctamente')
                    ->success()
                    ->send();
            });
    }

    private function user(): User
    {
        /** @var User $user */
        $user = auth()->user();

        return $user;
    }
}
