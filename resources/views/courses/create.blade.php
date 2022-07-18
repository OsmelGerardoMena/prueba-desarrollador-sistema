@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
  <h1>Crear curso</h1>
  <div class="lead">
  </div>

  <div class="container mt-4">
    <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label for="name" class="form-label">Imagen</label>
        <input type="file" name="img" class="form-control" placeholder="image">
        @if ($errors->has('img'))
        <span class="text-danger text-left">{{ $errors->first('img') }}</span>
        @endif
      </div>

      <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="Nombre" required>

        @if ($errors->has('name'))
        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
        @endif
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <input value="{{ old('email') }}" type="text" class="form-control" name="description" placeholder="" required>
        @if ($errors->has('description'))
        <span class="text-danger text-left">{{ $errors->first('description') }}</span>
        @endif
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
      </div>


      <div class="mb-3 ">
        <label for="name" class="form-label">Precios</label>

        <div class="form-group multi-field-wrapper">
          <table class="tabl">
            <tr>
              <td><button type="button" class="add-field btn btn-adds">Add Precio</button></td>
              <td>
                <div class="multi-fields">
                  <div class="multi-field">
                    <table class="tabl">
                      <tr>
                        <td>
                          <input type="number" class="form-control" name="precio[]" placeholder="Precio" style="width:95%" value="" />
                        </td>
                        <td>
                          <input type="text" class="form-control" name="simbolo[]" placeholder="$" style="width:95%" value="" />
                        </td>
                        <td>
                          <select name="pais[]" class="form-control" >
                            <option value="">País</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Estados unidos">Estados unidos</option>
                            <option value="España">España</option>
                          </select>
                        </td>
                        <td>
                          <button type="button" class="remove-field btn-removes">-</button>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </td>
            </tr>
          </table>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Guardar</button>
      <a href="{{ route('courses.index') }}" class="btn btn-default">Cancelar</a>
    </form>
  </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    jQuery('.multi-field-wrapper').each(function() {
        var jQuerywrapper = jQuery('.multi-fields', this);
        jQuery(".add-field", jQuery(this)).click(function(e) {
            jQuery('.multi-field:first-child', jQuerywrapper).clone(true).appendTo(jQuerywrapper).find('input').val('').focus();
        });
        jQuery('.multi-field .remove-field', jQuerywrapper).click(function() {
            if (jQuery('.multi-field', jQuerywrapper).length > 1)
                jQuery(this).parent('td').parent('tr').parent('tbody').parent('table').parent('.multi-field').remove();
        });
    });


</script>
@endsection