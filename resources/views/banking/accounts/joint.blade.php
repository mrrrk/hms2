@extends('layouts.app')

@section('pageTitle', 'Joint Accounts')

@section('content')
<div class="container">
  {{-- id --}}
  {{-- paymentRef --}}
  {{-- Users --}}
  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Payment Refrence</th>
          <th>Users</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($jointAccounts as $jointAccount)
        <tr>
          <td>{{ $jointAccount->getId() }}</td>
          <td>{{ $jointAccount->getPaymentRef() }}</td>
          <td>
          @foreach ($jointAccount->getUsers() as $user)
            {{ $user->getFullname() }}
            @if (! $loop->last)
                ,
            @endif
          @endforeach
          </td>
          <td class="actions"><a class="btn btn-primary" href="{{ route('banking.accounts.show', $jointAccount->getId()) }}"><i class="fas fa-eye" aria-hidden="true"></i> View</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="pagination-links">
    {{ $jointAccounts->links() }}
  </div>
</div>
@endsection
