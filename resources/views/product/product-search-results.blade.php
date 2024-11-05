{{-- resources/views/partials/product-search-results.blade.php --}}

<table id="clienttable" class="table table-bordered table-striped" p-1>
                      <thead>
                        <tr>
                          <th>
                            <input type="checkbox" class="checkAll" name="status" 
                                id="checkAll"
                            />
                          </th>
                          <th>Images</th>
                          <th width="200">Name</th>
                          <th width="200">Description</th>
                          <th  width="">status</th>
                          <th  width="150">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @forelse ($products as $product)
    <tr>
        <td>
            <input type="checkbox" name="status" value="{{ $product->id }}" />
        </td>
        <td><img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" width="50"></td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->short_description }}</td>
        <td>{{ $product->status }}</td>
        <td>
        <a href="javascript:void(0);" 
                            class="btn btn-xs btn-info float-left mr-2 btn-edit-client" 
                            data-id="{{ $product->id }}" 
                            data-url="{{ route('product.edit', $product->id) }}" 
                            title="Edit product" 
                            data-type="editmodal" 
                            onclick="popupmenu('{{ route('product.edit', $product->id) }}', 'editmodal', event); return false;">
                            <i class="fa fa-edit"></i>
                         </a>
                         <a href="{{route('product.delete', $product->id)}}" 
                            class="btn btn-xs btn-danger float-left mr-2"  
                            title="Delete product" 
                            onclick="popupmenu('{{route('product.delete', $product->id)}}', 'deletemodal', event); return false;">
                            <i class="fa fa-trash"></i>
                          </a>                  
           
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center">No products found.</td>
    </tr>
@endforelse
                      </tbody>
                    </table>


