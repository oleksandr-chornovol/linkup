<table class="table table-bordered">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Brand</th>
        <th>Price</th>
        <th style="width: 20%">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->title }}</td>
            <td>{{ $product->brand }}</td>
            <td>{{ $product->price }}</td>
            <td>
                <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                    <a href="/product/{{ $product->id }}" class="btn btn-info">View</a>
                    <a href="/product/{{ $product->id }}/edit" class="btn btn-success">Edit</a>

                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{!! $products->render() !!}
