@component('mail::message')
# Hello {{ $fullname }}

We are sorry to see you go, but as you have not made a payment recently your Nottingham Hackspace membership has been revoked and your access to the space has been suspended.

@if ($boxCount > 0)
Our records show that you have left a members box at the space please arange to collect it on a Wednesday Open Hack Night.<br>
@endif

@if ($snackspaceBalance < 0)
We request that you settle your snackspace balance of @money($snackspaceBalance, 'GBP')<br>
This can be paid off by cash in the space or by card online in HMS<br>
Or via bank transfer using the reference **{{ $snackspaceRef }}** to the Account number ans Sort Code below.<br>
@endif

If you do wish to reinstate your membership you will need to set up your standing order again.

Here are the details you need to set up a standing order:

@component('mail::panel')
Account number: {{ $accountNo }}<br>
Sort Code: {{ $sortCode }}<br>
Reference: {{ $paymentRef }}
@endcomponent

Once we've received your standing order (which may take 3-4 days to show up in our account after it leaves yours), your membership will be automatically reinstated.

Thanks,<br>
Nottinghack Membership Team
@endcomponent
