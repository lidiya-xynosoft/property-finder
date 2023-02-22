  <aside class="col-lg-3 col-md-12">
      <div class="widget">
          {{-- <h5 class="font-weight-bold mb-4">Search</h5>
          <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                  <button class="btn btn-primary" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
              </span>
          </div> --}}
          <div class="recent-post py-5">
              <h5 class="font-weight-bold">Category</h5>
              <ul>
                  @foreach ($categories as $category)
                      <li><a href="{{ route('blog.categories', $category->slug) }}"><i class="fa fa-caret-right"
                                  aria-hidden="true"></i>{{ $category->name }} ( {{ $category->posts_count }})</a></li>
                  @endforeach
              </ul>
          </div>
          <div class="recent-post">
              @php
                  $counter = 1;
              @endphp
              <h5 class="font-weight-bold mb-4">Popular Tags</h5>

              <div class="tags">

                  @foreach ($tags as $tag)
                      <span><a href="{{ route('blog.tags', $tag->slug) }}"
                              class="btn btn-outline-primary">{{ $tag->name }}</a></span>

                      @if ($counter % 2 === 0)
              </div>
              <div class="tags">
                  @endif
                  @php
                      $counter++;
                  @endphp
                  @endforeach

              </div>
          </div>
          <div class="recent-post pt-5">
              <h5 class="font-weight-bold mb-4">Popular Posts</h5>
              @foreach ($popularposts as $post)
                  <div class="recent-main">
                      @if (Storage::disk('public')->exists('posts/' . $post->image) && $post->image)
                          <div class="recent-img">
                              <a href="{{ route('blog.show', $post->slug) }}"><img
                                      src="{{ Storage::url('posts/' . $post->image) }}" alt="{{ $post->title }}"></a>
                          </div>
                      @endif

                      <div class="info-img">
                          <a href="blog-details.html">
                              <h6>{{ $post->title }}</h6>
                          </a>
                          <p>{{ $post->created_at->diffForHumans() }}</p>
                      </div>
                  </div>
              @endforeach
          </div>
      </div>
  </aside>
