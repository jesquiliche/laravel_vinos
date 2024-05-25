<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;
use App\MoonShine\Pages\Producto\ProductoIndexPage;
use App\MoonShine\Pages\Producto\ProductoFormPage;
use App\MoonShine\Pages\Producto\ProductoDetailPage;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Decorations\Block;
use MoonShine\Fields\File;
use MoonShine\Fields\ID;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use MoonShine\Fields\TextArea;
use MoonShine\Resources\ModelResource;
use MoonShine\Pages\Page;
use MoonShine\Fields\Image;

/**
 * @extends ModelResource<Producto>
 */
class ProductoResource extends ModelResource
{
    protected string $model = Producto::class;

    protected string $title = 'Productos';

    protected bool $createInModal = true; 
 
    protected bool $editInModal = true; 
 
    protected bool $detailInModal = true; 

    /**
     * @return list<Page>
     */
    public function pages(): array
    {
        return [
            ProductoIndexPage::make($this->title()),
            ProductoFormPage::make(
                $this->getItemID()
                    ? __('moonshine::ui.edit')
                    : __('moonshine::ui.add')
            ),
            ProductoDetailPage::make(__('moonshine::ui.show')),
        ];
    }

    /**
     * @param Producto $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'nombre' => 'required|min:4',
            'descripcion' => 'required',
            'tipo_id' => 'required',
            'denominacion_id' => 'required',
            'precio' => 'required|numeric',
            'maridaje' => 'required',
        ];
    }

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
            ]),

            Image::make('imagen')->allowedExtensions(['jpg', 'png', 'jpeg'])
                ->itemAttributes(fn (string $filename, int $index = 0) => [
                    'style' => 'width: 150px; height: 150px;'
                ]),
            BelongsTo::make('Tipo', 'tipo', 'nombre')->nullable(),
            BelongsTo::make('D.O.P', 'denominacion', 'nombre')->nullable(),
            Text::make('Nombre', 'nombre'),
            Textarea::make('Descripción', 'descripcion'),
            
           
            Textarea::make('Maridaje', 'maridaje'),
            Number::make('Graduación','graduacion')
            ->min(0)
            ->max(100)
            ->step(0.01),

            Number::make('Año','ano')
            ->min(1990)
            ->max(2024)
            ->step(1),

            Number::make('Precio')
                ->min(0)
                ->max(1000)
                ->step(0.01),

        ];
    }

    public function filters(): array
    {
        return [

            BelongsTo::make('Tipo', 'tipo', 'nombre')->nullable(),
            BelongsTo::make('Denominación', 'denominacion', 'nombre')->nullable(),
            Text::make('Nombre', 'nombre'),
        ];
    }
}
