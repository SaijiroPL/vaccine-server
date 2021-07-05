@extends('layouts.app')

@section('title', __('顧客一覧'))
@section('page_title', __('顧客一覧'))

@section('content')
<div class="m-portlet m-portlet--mobile m-portlet--body-progress-">
    <div class="m-portlet__body">
        <div class="row">
            <div class="col-md-12">
                <form class="navbar-form navbar-right" role="search" action="{{ url('/master/customer') }}">
                    <div class="form-group m-form__group pull-right" style="width: 40%">
                        <div class="input-group">
                            <input type="text" class="form-control" name="shop" value="{{ $old['shop'] }}" placeholder="店舗">
                            <input type="text" class="form-control" name="member_no" value="{{ $old['member_no'] }}" placeholder="ユーザーID">
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
                        <td>ユーザーID</td>
                        <td>パスワード</td>
                        <td>お気に入り店舗</td>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($customers as $ind => $u)
                        @php
                          $shop = App\Models\MyShop::get_my_shop($u->id);
                          $shopName = $shop ? $shop->name : '';
                        @endphp
                        <tr class="row-{{ (($customers->currentPage() - 1) * $per_page + $ind + 1)%2 }}" ref="{{ $u->id }}">
                        <td>{{ $u->id }}</td>
                        <td>{{ $u->member_no }}</td>
                        <td>{{ $u->password }}</td>
                        <td>{{ $shopName }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="100" class="no-items">検索結果がないです.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <div class="pull-right">{{ $customers->appends(['member_no' => $old['member_no']])->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
