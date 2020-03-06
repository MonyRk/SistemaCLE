<?php
namespace App\Exports;

use App\Alumno;
use App\Grupo;
use App\Membrete;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooterDrawing;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;
use App\Providers\AppServiceProvider;


class ListasExport implements FromView,WithDrawings,WithEvents//,ShouldAutoSize
{
    protected $grupo;
    public function  __construct($id)
    {
        $this->grupo = $id;
    }

    public function drawings()
    {
        $drawing = new HeaderFooterDrawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Encabezado');
        $drawing->setPath(public_path('/argon/img/brand/cabeceraL.png'));
        $drawing->setHeight(80);
        $drawing->setCoordinates('C1');

        return $drawing;
    }


    
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $cellRange = 'A6:AR45';
                $columns = ['E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR'];
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(7);
                $event->sheet->setOrientation('landscape');
                $event->sheet->getDelegate()->getStyle('A5')->getAlignment()->setHorizontal('center');
                $event->sheet->getDelegate()->getStyle('A6:AR39')->applyFromArray(
                    [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => 'thin',
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]
                );
                $event->sheet->getColumnDimension('A')->setAutoSize(true);
                $event->sheet->getColumnDimension('B')->setAutoSize(true);
                $event->sheet->getColumnDimension('C')->setAutoSize(true);
                $event->sheet->getColumnDimension('D')->setAutoSize(true);
                foreach ($columns as $column) {
                    $event->sheet->getDelegate()->getColumnDimension($column)->setWidth(1.7);
                }
                
                for ($i=6; $i < 40; $i++) { 
                    $event->sheet->getDelegate()->getRowDimension($i)->setRowHeight(13);
                }
            },
        ];
    }

    

    public function view(): View
    {

        $alumnos_en_el_grupo = Alumno::leftjoin('personas','alumnos.curp_alumno','=','personas.curp')
        ->leftjoin('alumno_inscrito','alumnos.num_control','=','alumno_inscrito.num_control')
        ->leftjoin('grupos','alumno_inscrito.id_grupo','=','grupos.id_grupo')
        ->whereNull('personas.deleted_at')
        ->whereNull('alumno_inscrito.deleted_at')
        ->where('alumno_inscrito.id_grupo',$this->grupo)
        ->get();

        $datosGrupo = Grupo::where('grupos.id_grupo',$this->grupo)
                            ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
                            ->leftjoin('aulas','aulas.id_aula','=','grupos.aula')
                            ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
                            ->leftjoin('docentes','docentes.id_docente','=','grupos.docente')
                            ->leftjoin('personas','docentes.curp_docente','=','personas.curp')
                            ->get();
        
        $membrete = Membrete::get();
        // dd($membrete);
       
        return view('pdf.listaGrupo',compact('alumnos_en_el_grupo','datosGrupo','membrete'));
        

    }
}
