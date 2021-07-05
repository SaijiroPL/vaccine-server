@extends('layouts.app')

@section('title', __('ショップ一覧'))
@section('page_title', __('ショップ一覧'))

@section('content')
<form class="m-form m-form--fit m-form--label-align-right" id="del_form" action="/shop/delete" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type=hidden id="del_id" name="del_no" />
<div class="m-portlet m-portlet--mobile m-portlet--body-progress-">
    <div class="m-portlet__body">
        <div class="row">
            <div class="col-md-12 m--padding-bottom-15">
                <a href="{{ url('/shop/edit') }}" class="btn btn-primary">
                  <span>
                      <i class="fa flaticon-add-circular-button"></i>
                      <span>&nbsp;&nbsp;ショップ追加&nbsp;&nbsp;</span>
                  </span>
                </a>
                <form class="navbar-form navbar-right" role="search" action="{{ url('/master/customer') }}">
                  <div class="form-group m-form__group pull-right" style="width: 40%">
                    <div cl ass="input-group">
                      <input type="text" class="form-control" name="shop" placeholder="店舗">
                      <input type="text" class="form-control" name="member_no" placeholder="ユーザーID">
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                          <span>
                            <i class="fa fa-search"></i>
                            <span>&nbsp;&nbsp;検 索&nbsp;&nbsp;</span>
                          </span>
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
            </div>
            <div class="col-md-12">
                <table width="100%" class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>ショップ名</td>
                            <td>ショップエリア</td>
                            <td>ショップエリア詳細</td>
                            <td>住所</td>
                            <td>郵便番号</td>
                            <td>電話番号</td>
                            <td>画像</td>
                            <td>動作</td>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($shops as $ind => $u)
                        <tr class="row-{{ (($shops->currentPage() - 1) * $per_page + $ind + 1)%2 }}" ref="{{ $u->id }}">
                            <td>{{ ($shops->currentPage() - 1) * $per_page + $ind + 1 }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->name_p }}</td>
                            <td>{{ $u->name_c }}</td>
                            <td>{{ $u->address }}</td>
                            <td>{{ $u->postal }}</td>
                            <td>{{ $u->tel_no }}</td>
                            <td>
                                <div><img src="{{ $image_url.$u->image }}" style="height:50px"/></div>
                            </td>
                        <td>
                            <div class="p-action">
                                <a href="/shop/edit/{{ $u->id }}" class="btn btn-outline-primary m-btn m-btn--icon m-btn--icon-only"><i class="fa fa-edit"></i></a>
                                <a href="#" onclick="delete_confirm('{{ $u->id }}');" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                        </tr>
                    @empty
                        <tr><td colspan="100" class="no-items">検索結果がないです.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <div class="pull-right">{{ $shops->links() }}</div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection

@section('script')
<script>
        function delete_confirm(del_id){

            swal({title:"本当に削除しますか？",
                    text:"削除すると元に戻せません",
                    showCancelButton:!0,
                    confirmButtonText:"はい",
                    cancelButtonText:"キャンセル",
                })
                .then(function(e){
                    if (e.value == 1)
                    {
                        $('#del_id').val(del_id);
                        $('#del_form').submit();
                    }
                })

        }
</script>
@endsection
