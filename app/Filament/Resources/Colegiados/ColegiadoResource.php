<?php

namespace App\Filament\Resources\Colegiados;

use App\Enums\UserRole;
use App\Filament\Resources\Colegiados\Pages\ListColegiados;
use App\Filament\Resources\Colegiados\Pages\ViewColegiado;
use App\Models\User;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class ColegiadoResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $modelLabel = 'colegiado';

    protected static ?string $pluralModelLabel = 'colegiados';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('role', UserRole::Colegiado)
            ->with(['matricula', 'sss', 'habilitacionLaboratorio']);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('nombre')
            ->columns([
                TextColumn::make('nombre')->searchable(),
                TextColumn::make('apellido')->searchable(),
                TextColumn::make('laboratorio')->searchable(),
                TextColumn::make('matricula.fecha_vencimiento')
                    ->label('Matrícula vence')
                    ->date('d/m/Y')
                    ->placeholder('Sin cargar'),
                TextColumn::make('sss.fecha_vencimiento')
                    ->label('SSS vence')
                    ->date('d/m/Y')
                    ->placeholder('Sin cargar'),
                TextColumn::make('habilitacionLaboratorio.fecha_vencimiento')
                    ->label('Habilitación vence')
                    ->date('d/m/Y')
                    ->placeholder('Sin cargar'),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Section::make('Datos personales')
                    ->icon('heroicon-o-user-circle')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextEntry::make('nombre'),
                        TextEntry::make('apellido'),
                        TextEntry::make('email')
                            ->icon('heroicon-o-envelope')
                            ->copyable()
                            ->copyMessage('Email copiado')
                            ->url(fn (User $record): string => "mailto:{$record->email}"),
                        TextEntry::make('laboratorio')
                            ->icon('heroicon-o-building-office-2'),
                    ]),

                static::documentoSection(
                    relation: 'matricula',
                    routeName: 'descargas.matriculas',
                    titulo: 'Matrícula',
                    icon: 'heroicon-o-identification',
                    color: 'info',
                ),

                static::documentoSection(
                    relation: 'sss',
                    routeName: 'descargas.sss',
                    titulo: 'SSS',
                    icon: 'heroicon-o-shield-check',
                    color: 'warning',
                    extraFields: [
                        TextEntry::make('sss.numero_inscripcion')
                            ->label('Número de inscripción')
                            ->placeholder('Sin cargar'),
                    ],
                ),

                static::documentoSection(
                    relation: 'habilitacionLaboratorio',
                    routeName: 'descargas.habilitaciones',
                    titulo: 'Habilitación de laboratorio',
                    icon: 'heroicon-o-beaker',
                    color: 'success',
                ),
            ]);
    }

    /**
     * @param  array<int, mixed>  $extraFields
     */
    private static function documentoSection(string $relation, string $routeName, string $titulo, string $icon, string $color, array $extraFields = []): Section
    {
        return Section::make($titulo)
            ->icon($icon)
            ->iconColor($color)
            ->schema([
                ...$extraFields,
                TextEntry::make("{$relation}.fecha_expedicion")
                    ->label('Expedición')
                    ->date('d/m/Y')
                    ->placeholder('Sin cargar'),
                TextEntry::make("{$relation}.fecha_vencimiento")
                    ->label('Vencimiento')
                    ->date('d/m/Y')
                    ->badge()
                    ->color(fn (User $record): ?string => static::colorVencimiento($record->{$relation}?->fecha_vencimiento))
                    ->placeholder('Sin cargar'),
                TextEntry::make("{$relation}_archivo")
                    ->label('Archivo')
                    ->state(fn (User $record): string => $record->{$relation} ? 'Ver / descargar' : 'Sin cargar')
                    ->icon(fn (User $record): string => $record->{$relation} ? 'heroicon-o-arrow-down-tray' : 'heroicon-o-minus-circle')
                    ->iconPosition('before')
                    ->color(fn (User $record): string => $record->{$relation} ? $color : 'gray')
                    ->url(fn (User $record): ?string => $record->{$relation} ? route($routeName, $record->{$relation}) : null)
                    ->openUrlInNewTab(),
            ]);
    }

    private static function colorVencimiento(?Carbon $fechaVencimiento): ?string
    {
        if (! $fechaVencimiento) {
            return null;
        }

        return match (true) {
            $fechaVencimiento->isPast() => 'danger',
            $fechaVencimiento->lessThanOrEqualTo(now()->addDays(60)) => 'warning',
            default => 'success',
        };
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListColegiados::route('/'),
            'view' => ViewColegiado::route('/{record}'),
        ];
    }
}
