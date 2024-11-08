  @forelse ($comments as $comment)
      <div class="spr-review d-flex w-100">
          <div style="height: 65px;" class="me-2">
              <img src="{{ $comment->user->avatar
                  ? asset('storage/' . $comment->user->avatar)
                  : 'https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg' }}"
                  alt="avatar"
                  style="width: 65px; height:65px; object-fit: cover;"
                  class="rounded-circle blur-up lazyloaded me-4" />
          </div>
          <div class="spr-review-content flex-grow-1">
              <div
                  class="title-review d-flex align-items-center justify-content-between">
                  <div>
                      <h5>{{ $comment->user->name }}</h5>
                      <span class="product-review spr-starratings">
                          @for ($i = 0; $i < 5; $i++)
                              <i
                                  class="icon anm anm-star {{ $i < $comment->rating ? '' : 'anm-star-o' }}"></i>
                          @endfor
                      </span> |
                      {{ $comment->created_at->format('d-m-Y H:i') }}
                  </div>

              </div>
              <p>{{ $comment->comment }}</p>
          </div>
      </div> <br>
      <hr>
  @empty
      <p>Chưa có bình luận nào.</p>
  @endforelse