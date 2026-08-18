<?php

namespace App\Http\Controllers;

use App\Models\HabilitacionLaboratorio;
use App\Models\Matricula;
use App\Models\Sss;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LegajoDocumentoController extends Controller
{
    public function matricula(Matricula $matricula): StreamedResponse
    {
        Gate::authorize('view', $matricula);

        return $this->download($matricula->archivo_path);
    }

    public function sss(Sss $sss): StreamedResponse
    {
        Gate::authorize('view', $sss);

        return $this->download($sss->archivo_path);
    }

    public function habilitacion(HabilitacionLaboratorio $habilitacionLaboratorio): StreamedResponse
    {
        Gate::authorize('view', $habilitacionLaboratorio);

        return $this->download($habilitacionLaboratorio->archivo_path);
    }

    private function download(string $archivoPath): StreamedResponse
    {
        return Storage::disk(config('filesystems.legajos_disk'))->download($archivoPath);
    }
}
