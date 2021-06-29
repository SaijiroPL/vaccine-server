@extends('layouts.app')

@section('title', __('施工商品追加'))
@section('page_title', __('施工商品追加'))

@section('content')
<div class="m-portlet m-portlet--tab">
    <!--begin::Form-->
<form class="m-form m-form--fit m-form--label-align-right" action="/master/carrying_goods/update" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="no" value="{{ isset($goods) ?  $goods->id : '' }}" />
        <div class="m-portlet__body">
            <div class="form-group m-form__group row" style="display: none">
                <label for="exampleSelect1" class="col-2 col-form-label">種類</label>
                <div class="col-6">
                    <select class="form-control m-input" name="type">
                        @if (isset($goods) && $goods->type == 1)
                          <option value="0">そのた</option>
                          <option value="1" selected>フォン</option>
                        @else
                          <option value="0" selected>そのた</option>
                          <option value="1">フォン</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">施工商品名</label>
                <div class="col-6">
                    <input class="form-control m-input" type="text" name="name" value="{{ isset($goods) ? $goods->name : '' }}"
                    required data-msg-required="施工商品名を選択してください.">
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">価格</label>
                <div class="col-6">
                    <input class="form-control m-input" type="number" name="price" value="{{ isset($goods) ? $goods->price : '' }}"
                    data-msg-required="価格を選択してください." data-msg-number='数を入力してください'>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="exampleInputEmail1" class="col-2 col-form-label">画像</label>
                <div class="col-6">
                    <div class="input-group">
                        <input type="text" class="form-control m-input" name="thumb" id="path_dsp"
                            value="{{ isset($goods) ? $goods->image : '' }}" required
                            placeholder="画像を選択してください." data-msg-required="画像を選択してください." readonly>

                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary" onclick="$('#path').click();" >Browse...</button>
                        </div>
                    </div>
                </div>
            </div>
            <input type="file" name="thumbnail" id="path" style="display: none;" accept="image/*">
            <div class="form-group m-form__group row">
                <div class="offset-2 col-md-9">
                    <div id="div_img">
                        @if (isset($goods))
                            <img src="{{ asset( $image_url.$goods->image ) }}" height="100%">
                        @endif
                    </div>
                </div>
            </div>
            @if (isset($goods))
            <div class="form-group row">
              <div class="col-md-2 offset-1">
                <button type="button" class="btn btn-success btn-block" onclick="goToDetails()">サイズ追加</button>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-1 offset-1">

              </div>
              <div class="col-md-6">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <td>サイズ</td>
                      <td>価格</td>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($goods->details as $d)
                      <tr>
                        <td>{{ $d->name }}</td>
                        <td>{{ $d->price }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            @endif
        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions">
                <div class="row">
                    <div class="col-2 offset-2">
                        <button type="submit" class="btn btn-success btn-block">OK</button>
                    </div>
                    <div class="col-2">
                            <a href="{{ url('/master/carrying_goods') }}" class="btn btn-secondary btn-block">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
    $(function() {
        $('form').validate();

        $('input[name="thumbnail"]').on('change', function() {
            $('input[name="change_thumb"]').val(1);
            if (this.files.length === 0)
                return;
            var f = this.files[0];
            var reader = new FileReader();
            reader.onload = (function (file) {
                return function(e) {
                    $('#div_img').addClass('img');
                    $('#div_img').html('<img src="' + e.target.result + '" height="100%">');
                };
            })(f);
            reader.readAsDataURL(f);
        });

        $('#path').on('change', function () {
            if ($(this).val() === '')
                return;
            $('#path_dsp').val($(this).val());
        });
    })
    function goToDetails() {
      location.href = "/master/carrying_goods/detail/" + "{{ isset($goods) ?  $goods->id : '' }}";
    }
</script>
@endsection
