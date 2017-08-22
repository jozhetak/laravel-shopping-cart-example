 @foreach ($items as $product)
    <div class="col-md-3">
        <div class="thumbnail">
            <div class="caption text-center">
                {{ $product->name }}
                <a href="{{ url('shop', [$product->slug]) }}"><img src="{{ asset('img/' . $product->image) }}" alt="product" class="img-responsive"></a>
                <a href="{{ url('shop', [$product->slug]) }}"><h3>{{ $product->name }}</h3>
                    <p>{{ $product->price /100 }}</p>
                </a>
                @if( !Auth::guest() && Auth::user()->theboss )
                    <a href="{{ route('/delete', ['slug' => $product->slug]) }}" class="btn btn-danger">Delete</a>
                @endif
            </div> <!-- end caption -->
        </div> <!-- end thumbnail -->
        <h3>${{ $product->price / 100}}</h3>

        <form action="{{ url('/cart') }}" method="POST" class="side-by-side">
            {{ csrf_field() }}
            <input type="hidden" name="id" v-model="this.id" value="{{ $product->id }}">
            <input type="hidden" name="name" v-model="this.name" value="{{ $product->name }}">
            <input type="hidden" name="price" v-model="this.price" value="{{ $product->price }}">

            <addToCart :product="{{ $product }}"></addToCart>

            <noscript>
                <input type="submit" value="Add To Cart" class="btn btn-success">
            </noscript>
        </form>

        <div class="spacer"></div>
    </div> <!-- end col-md-3 -->
@endforeach