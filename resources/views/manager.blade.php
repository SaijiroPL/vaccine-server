@extends('layouts.app')

@section('title', __('代理店マスタ管理'))
@section('page_title', __('代理店マスタ管理'))

@section('content')
<div class="m-portlet m-portlet--mobile m-portlet--body-progress-">
    <div class="m-portlet__body">
        <div class="row">
            <div class="col-md-12">
                <table width="100%" class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>店舗</td>
                            <td>ID</td>
                            <td>パスワード</td>
                            <td>許可状態</td>
                            <td>動作</td>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($managers as $ind => $u)
                        <tr class="row-{{ (($managers->currentPage() - 1) * $per_page + $ind + 1)%2 }}" ref="{{ $u->id }}">
                            <td>{{ ($managers->currentPage() - 1) * $per_page + $ind + 1 }}</td>
                            <td>
                                {{ $u->shop_name }}
                            </td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->real_password }}</td>
                            <td>
                              @if ($u->allow == 1)
                                許可
                              @else
                                禁止
                              @endif
                            </td>
                            <td>
                              <div class="p-action">
                                @if ($u->allow == 0)
                                  <a href="/manager/allow/{{ $u->id }}" class="btn btn-outline-primary">許可</a>
                                @else
                                  <a href="/manager/allow/{{ $u->id }}" class="btn btn-outline-primary">禁止</a>
                                @endif
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
                <div class="pull-right">{{ $managers->links() }}</div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function manager_allow(id){
      swal({title:"Are you sure?",
          text:"You won't be able to revert this!",
          showCancelButton:!0,
          confirmButtonText:"Yes, delete it!",
          cancelButtonText:"No, cancel!",
      })
      .then(function(e){
          if (e.value == 1)
          {
              $('#id').val(id);
              $('#allow').val(allow);
              $('#form').submit();
          }
      })
    }
</script>
@endsection
