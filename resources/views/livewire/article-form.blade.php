<div>
<h1>Crear Articulo</h1>
<form wire:submit.prevent="save">
    <label>
        <input wire:model="article.title" type="text" placeholder="Titulo">
        @error('title')<div>{{ $message }}</div>@enderror
    </label>
    <label>
        <textarea wire:model="article.content" placeholder="Contenido"></textarea>
    </label>
    <input  type="submit" value="Guardar">
</form>

</div>
