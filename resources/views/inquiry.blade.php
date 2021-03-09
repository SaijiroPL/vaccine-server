@extends('layouts.app')

@section('title', __('お問い合わせ一覧'))
@section('page_title', __('お問い合わせ一覧'))

@section('content')
<div class="m-portlet m-portlet--mobile m-portlet--body-progress-">
    <div class="m-portlet__body">
        <div class="row">
            <div class="col-md-12">
                <form class="navbar-form navbar-right" role="search" action="{{ url('/master/inquiry') }}">
                    <div class="form-group m-form__group pull-right" style="width: 25%">
                        <div class="input-group">
                            <input type="text" class="form-control" name="shop_name" value="{{ $old['shop_name'] }}" placeholder="店舗">
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
                            <td>お問い合わせ店舗</td>
                            <td>お問い合わせ内容</td>
                            <td>顧客名</td>
                            <td>日付</td>
                            <td>送信者</td>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($inquiries as $ind => $u)
                        <tr class="row-{{ (($inquiries->currentPage() - 1) * $per_page + $ind + 1)%2 }}" ref="{{ $u->no }}">
                            <td>{{ ($inquiries->currentPage() - 1) * $per_page + $ind + 1 }}</td>
                            <td>{{ $u->name }}</td>
                            <td><pre>{{ $u->content }}</pre></td>
                            <td>{{ $u->customer }}</td>
                            <td>{{ $u->date }}</td>
                            <td>{{ $u->sender }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="100" class="no-items">検索結果がないです.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <div class="pull-right">{{ $inquiries->appends(['shop_name' => $old['shop_name']])->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
