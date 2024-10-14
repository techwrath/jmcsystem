<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;


class ProductsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('productImage', function (Product $product) {
                $url = asset($product?->productImage);
                return '<img src='.$url.' border-radius: 50%; width="50" overflow: hidden; class="img-circle" align="center" display: inline-block;/>'; 
            })
            ->addColumn('action', function( $data){
                 $id= $data->id;
                return "<div>
                <a id='editProductBtn' type='button' data-id='$id'   class='text-primary'><i class='fas fa-edit'></i></a>
                <a id='deleteBtn' data-id='$id'  class='text-danger'><i class='fas fa-trash'></i></a>
                </div>";
               })
            ->rawColumns(['productImage', 'action'])
            
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $product): QueryBuilder
    {
        return $product->newQuery()->select('id','productName','productImage', 'productDescription', 'productBrand');
       
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('productsTable')
                    ->columns($this->getColumns())
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
            Column::make('productImage'),
            Column::make('productName'),
            Column::make('productDescription'),
            Column::make('productBrand'), 
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Products_' . date('YmdHis');
    }
}
