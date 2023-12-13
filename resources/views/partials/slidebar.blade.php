<button class="btn btn-secondary form-control m-2">Deposit:  {{Auth::user()->deposit ? Auth::user()->deposit : '0'}}$</button>
<a href="{{ route('home') }}" class="btn btn-success form-control m-2">All Ads</a>
<a href="{{ route('home.showMessages') }}" class="btn btn-secondary form-control m-2 position-relative">Message <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{Auth::user()->messages->count()}}</span></a>
<a href="{{ route('home.addDeposit')}}" class="btn btn-success form-control m-2">Ad deposit</a>
<a href="{{ route('home.showForm') }}" class="btn btn-secondary form-control m-2">New Ad</a>