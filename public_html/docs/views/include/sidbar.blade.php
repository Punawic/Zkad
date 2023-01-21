<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li class="mm-active"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="true">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <ul aria-expanded="false" class="mm-collapse mm-show">
                    <li><a href="{{ route('dashboard') }}"><b>- Dashboard</b></a></li>
                    @if (Auth::user()->user_type == 'admin') 
                        <li><a href="{{ route('cashflow.index') }}"><b>- Cashflow</b> <br>คาดการณ์รายได้</a></li>
                        <li><a href="{{ route('page.index') }}"><b>- Page </b><br>เพจ</a></li>
                        <li><a href="{{ route('campaign.index') }}"><b>- Campaign</b> <br>แคมเปญ</a></li>
                        <li><a href="{{ route('sales.index') }}"><b>- Sale </b><br>ยอดขาย</a></li>
                        <li><a href="{{ route('advertising.index') }}"><b>- Advertising </b><br>ค่าโฆษณา</a></li>
                        <li><a href="{{ route('delivery.index') }}"><b>- Delivery </b><br>ติดตั้งค่าส่ง</a></li>
                        <li><a href="{{ route('shipping.index') }}"><b>- Shipping Cost </b><br>ค่าขนส่งจริง</a></li>
                        <li><a href="{{ route('income.index') }}"><b>- Income </b><br>รายรับ</a></li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><b>- Return percent</b></a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('percent.index') }}"><b>- Return percent By Day </b><br>เปอร์เซนต์คืนรายวัน</a></li>
                                <li><a href="{{ route('percent.create') }}"><b>- Return percent By Page </b><br>เปอร์เซ็นต์คืนแยกเพจ</a></li>
                            </ul>
                        </li>
                        @else
                        @if (!empty(Auth::user()->role) || Auth::user()->role != null)
                            
                            @foreach (json_decode(Auth::user()->role) as $item)
                                @if ($item == 'Page')
                                <li><a href="{{ route('page.index') }}"><b>- Page </b><br>เพจ</a></li>
                                @endif
                                @if ($item == 'Cashflow')
                                <li><a href="{{ route('cashflow.index') }}"><b>- Cashflow </b><br>คาดการณ์รายได้</a></li>
                                @endif
                                @if ($item == 'Shipping')
                                <li><a href="{{ route('shipping.index') }}"><b>- Shipping Cost</b><br>ค่าขนส่งจริง</a></li>
                                @endif    
                                @if ($item == 'Campaign')
                                <li><a href="{{ route('campaign.index') }}"><b>- Campaign </b> <br>แคมเปญ</a></li>
                                @endif
                                @if ($item == 'Sale')
                                <li><a href="{{ route('sales.index') }}"><b>- Sale </b><br>ยอดขาย</a></li>
                                @endif
                                @if ($item == 'Advertising')
                                <li><a href="{{ route('advertising.index') }}"><b>- Advertising</b><br>ค่าโฆษณา</a></li>
                                @endif
                                @if ($item == 'Delivery')
                                <li><a href="{{ route('delivery.index') }}"><b>- Delivery </b><br>ติดตั้งค่าส่ง</a></li>
                                @endif
                                @if ($item == 'Return Percent')
                                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">- Return percent</a>
                                    <ul aria-expanded="false">
                                        <li><a href="{{ route('percent.index') }}"><b>- Return percent By Day </b><br>เปอร์เซนต์คืนรายวัน</a></li>
                                        <li><a href="{{ route('percent.create') }}"><b>- Return percent By Page </b><br>เปอร์เซ็นต์คืนแยกเพจ</a></li>
                                    </ul>
                                </li>
                                @endif
                            @endforeach
                        @endif


                    @endif

                    
                    {{-- <li><a href="{{ route('delivery.index') }}">- Delivery</a></li> --}}
                    <!-- <li><a href="{{ route('percent.index') }}">Return percent</a></li> -->
                    {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">- Return percent</a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('percent.index') }}">- Return percent By Day</a></li>
                            <li><a href="{{ route('percent.create') }}">- Return percent By Page</a></li>
                        </ul>
                    </li> --}}
                    @if (Auth::user()->user_type == 'admin') 
                        <li><a href="{{ route('users.index') }}"><b>- User Management </b><br>การจัดการผู้ใช้งาน</a></li>
                    @endif
                    <li><a href="{{ route('setting.index') }}"><b>- Profile Setting </b><br>การตั้งค่าผู้ใช้งาน</a></li>
                    
                    <li><a href="{{ route('logout') }}"><b>Logout </b></a></li>
                </ul>
            </li>
        </ul>
        {{-- <div class="copyright">
            <p>Zactra Admin Dashboard <br/>© {{ date('Y') }} All Rights Reserved</p>
            <p class="op5">Made with <span class="heart"></span> by Zactra</p>
        </div> --}}
    </div>
</div>