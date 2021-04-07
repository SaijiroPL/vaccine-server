@extends('layouts.app')

@section('title', __('施工マニュアル一覧'))
@section('page_title', __('施工マニュアル一覧'))

@section('content')
<div class="m-portlet">
    <div class="m-portlet__body">
        <div class="row">
            @if (isset($data) && count($data) > 0)
                @foreach ($data as $v)
                <div class="col-3">
                    <div class="m-alert m-alert--outline m-alert--outline-2x alert alert-success alert-dismissible text-center" role="alert">
                        <button type="button" class="close" onclick="delete_manual({{$v->id}})">
                        </button>
                        <p><i class="fa fa-file-pdf" style="font-size: 40px;"></i></p>
                        <a href="{{$v->url}}">{{$v->display_name}}</a>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="m-alert m-alert--icon alert alert-danger" role="alert">
                        <div class="m-alert__icon">
                            <i class="la la-warning"></i>
                        </div>
                        <div class="m-alert__text">
                            <h5>登録された施工マニュアルがないです.</h5>
                            施工マニュアルを登録してください.
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="row m--margin-top-15">
            <div class="col-2 offset-5">
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#m_modal_1">登録</button>
            </div>
        </div>
    </div>
  </div>
  <div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">施工マニュアル登録</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="m-form m-form--fit m-form--label-align-right"
                        action="{{ url('/manual/add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group m-form__group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile"
                                    name="file" accept="application/pdf"
                                    required data-msg-required="登録するマニュアルを選択してください.">
                                <label class="custom-file-label" for="customFile">登録するマニュアルを選択してください.</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="submit">OK</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    function delete_manual(id) {
        if (!id) return;
        if (confirm('マニュアルを削除しますか?'))
            location.href="{{url('/manual/delete')}}" + '/' + id;
    }

    $(function() {
        $('form').validate();
        $('#submit').on('click', function() {
            $('form').submit();
        });
    });
</script>
@endsection
