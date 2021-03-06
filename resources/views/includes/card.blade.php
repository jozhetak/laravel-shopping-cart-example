<div class="card">
    @if($product->is_on_sale)
        <div class="sales">
            <h2>{{ $product->sales->percentage  * 100 }}% Off!
                <span><small>was ${{ $product->regularPrice() }}</small></span>
            </h2>
        </div>
    @endif
    <div class="card-image waves-effect waves-light waves-block">
        <img class="activator" src="/img/{{ $product->image }}" alt="Picture of {{ $product->name }}">
        <span class="card-title white black-text"><strong>${{ $product->price() }}</strong></span>
    </div>
    <div class="card-content">
        <span class="card-title activator left cyan-text">{{ $product->name }}
            <i class="material-icons">more_vert</i>
        </span>
          <!-- add activator to anything -->
        @if( $product->is_eighty_six() )
            <img class="activator sold-out right" src="/images/sold_out_stamp_cropped.jpg" alt="Product sold out !">
        @endif
        <div class="clearfix"></div>
    </div>

    <div class="card-action">
        <a class="activator" href="#!">Read More</a>
        <favorite class="ml-20" :product="{{ $product }}"></favorite>
        @if($_SERVER['REQUEST_URI'] != "/shop/$product->slug")
            <a class="btn cyan right" href="/shop/{{ $product->slug }}">View Product</a>
        @endif
    </div>
      <!-- inside of reveal -->
    <div class="card-reveal">
        <h1 class="card-title blue-text">{{ $product->name }}
            <i class="material-icons">close</i>
        </h1>
        <p class="cyan-text">{{ $product->description }}</p>
        <p>{{ $product->price() }}</p>
        @if($product->is_eighty_six())
            <img class="activator sold-out right" src="/images/sold_out_stamp_cropped.jpg" alt="Product sold out !">
        @else
            <add-to-cart
                :product="{{ $product }}"
                @if( $product->group )
                    :options="{{ $product->options() }}"
                @endif
                @if( $product->secondGroup )
                    :secondoptions="{{ $product->secondOptions() }}"
                @endif
            >
            </add-to-cart>
        @endif
        @can('see-admin-menu')
            <form method="POST" action="/delete/{{$product->slug}}/product" class="deleteForm">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" name="submit" class="btn red danger deleteButton">Delete</button>
            </form>
            <a href="/update/{{ $product->slug }}" class="btn blue product-layout-img">Update</a>
        @endcan
    </div>
</div>