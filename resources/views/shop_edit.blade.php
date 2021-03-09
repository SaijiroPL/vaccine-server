@extends('layouts.app')

@section('title', __('ショップ追加'))
@section('page_title', __('ショップ追加'))

@section('content')
<div class="m-portlet m-portlet--tab">
    <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right" action="/shop/update" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="no" value="{{ isset($shop) ?  $shop->no : '' }}" />
        <div class="m-portlet__body">
            <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-3 col-form-label">ショップ名</label>
                <div class="col-5">
                    <input class="form-control m-input" type="text" name="name" value="{{ isset($shop) ? $shop->name : '' }} "
                    required data-msg-required="ショップ名を選択してください.">
                </div>
            </div>
            {{-- <div class="form-group m-form__group row">
                <label for="exampleSelect1" class="col-3 col-form-label">ショップエリア</label>
                <div class="col-5">
                    <select class="form-control m-input" name="province">
                        @foreach ($provinces as $ind => $p)
                            @if (isset($shop) && $shop->province_no == $p->no)
                                <option value="{{ $p->no }}" selected>{{ $p->province_name }}</option>
                            @else
                                <option value="{{ $p->no }}">{{ $p->province_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="exampleSelect1" class="col-3 col-form-label">ショップエリア詳細</label>
                <div class="col-5">
                    <select class="form-control m-input" name="county">
                    </select>
                </div>
            </div> --}}
            <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-3 col-form-label">住所</label>
                <div class="col-5">
                    <input class="form-control m-input" type="text" name="address" value="{{ isset($shop) ? $shop->address : '' }} "
                    required data-msg-required="住所を選択してください.">
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-3 col-form-label">郵便番号</label>
                <div class="col-5">
                    <input class="form-control m-input" type="text" name="postal" value="{{ isset($shop) ? $shop->postal : '' }} "
                    required data-msg-required="郵便番号を選択してください.">
                </div>
            </div>
            <div class="form-group m-form__group row">
                    <label for="example-text-input" class="col-3 col-form-label">電話番号</label>
                    <div class="col-5">
                        <input class="form-control m-input" type="text" name="tel_no" value="{{ isset($shop) ? $shop->tel_no : '' }} "
                        required data-msg-required="電話番号を選択してください.">
                    </div>
                </div>
            <div class="form-group m-form__group row">
                <label for="exampleInputEmail1" class="col-3 col-form-label">画像</label>
                <div class="col-5">
                    <div class="input-group">
                        <input type="text" class="form-control m-input" name="thumb" id="path_dsp"
                            value="{{ isset($shop) ? $shop->image : '' }}" required
                            placeholder="画像を選択してください." data-msg-required="画像を選択してください." readonly>

                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary" onclick="$('#path').click();" >Browse...</button>
                        </div>
                    </div>
                </div>
            </div>
            <input type="file" name="thumbnail" id="path" style="display: none;" accept="image/*">
            <div class="form-group m-form__group row">
                <div class="offset-3 col-md-9">
                    <div id="div_img" onclick="$(this).html('');$(this).removeClass('img');$('#path_dsp, #path').val('');">
                        @if (isset($shop))
                            <img src="{{ asset( $image_url.$shop->image ) }}" height="100%">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions">
                <div class="row">
                    <div class="col-2 offset-3">
                        <button type="submit" class="btn btn-success btn-block">OK</button>
                    </div>
                    <div class="col-2">
                            <a href="{{ url('/shop') }}" class="btn btn-secondary btn-block">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
    function onChangeProvince() {
        var province_no = $('select[name="province"]').val();
        $.ajax({
            method: "POST",
            url: "/shop/get_counties_by_province",
            dataType: "json",
            data:{
                _token: '{{ csrf_token() }}',
                province_no:province_no,
            },
            success: function (data) {
                var html = '';
                for (var i = 0; i < data.length; i++) {
                    selected = ''
@if (isset($shop))
                    if (data[i].no == {{ $shop->county_no }})
                        selected = 'selected';
@endif
                    html += '<option value="' + data[i].no + '" ' + selected + '>' + data[i].county_name + '</option>';
                }
                $('select[name="county"]').html(html);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Connection error. Please check the connection to the server.');
            }
        });
    }

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

        {{-- $('select[name="province"]').on('change', onChangeProvince);
        onChangeProvince(); --}}

    });
</script>
@endsection
