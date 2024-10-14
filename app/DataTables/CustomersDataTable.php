<?php

namespace App\DataTables;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CustomersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('#', function ($row) {
            // The serial number will be rendered on the client-side
            static $index = 0; // Static variable to maintain the index across multiple rows
            return ++$index + $this->request->get('start');
        })
        ->addColumn('action', function( $data){
            $id= $data->id;
           return "<div>
           <a id='editProductBtn' type='button' data-id='$id'   class='text-primary'><i class='fas fa-edit'></i></a>
           <a id='deleteBtn' data-id='$id'  class='text-danger'><i class='fas fa-trash'></i></a>
           </div>";
          })
       ->rawColumns(['action','#'])
       
       ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Customer $customer): QueryBuilder
    {
        return $customer->newQuery()->select('id','customerNo','customerName','phoneNumber','areaCode', 'status');
        
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('customers-table')
                    ->columns($this->getColumns())
                    ->parameters(['ordering' => false,])
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            ['data' => '#', 'name' => '#', 'title' => '#'],
            Column::make('customerNo'),
            Column::make('customerName'),
            Column::make('phoneNumber'),
            Column::make('areaCode'),
            Column::make('status'), 
            Column::computed('action')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Customers_' . date('YmdHis');
    }
}
