<ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
    <li class="nav-item"><a class="nav-link" href="{{route('home')}}">
        <svg class="nav-icon">
          <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-speedometer')}}"></use>
        </svg> Dashboard
        </a>
      </li>
    @if (auth()->user()->id==1 || auth()->user()->id==2)

    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
      <svg class="nav-icon">
        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-puzzle')}}"></use>
      </svg> Masters</a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="{{route('operation.index')}}"><span class="nav-icon"></span> Operation</a></li>  
        <li class="nav-item"><a class="nav-link" href="{{route('category.index')}}"><span class="nav-icon"></span> Category </a></li>  
        <li class="nav-item"><a class="nav-link" href="{{route('type.index')}}"><span class="nav-icon"></span> Type</a></li>  
        <li class="nav-item"><a class="nav-link" href="{{route('raw_material.index')}}"><span class="nav-icon"></span> Raw Material </a></li>  
        <li class="nav-item"><a class="nav-link" href="{{route('child_part_number.index')}}"><span class="nav-icon"></span> Child Part Number</a></li>  
        <li class="nav-item"><a class="nav-link" href="{{route('part_master.index')}}"><span class="nav-icon"></span>  Child Part Master</a></li>  
        <li class="nav-item"><a class="nav-link" href="{{route('nesting.index')}}"><span class="nav-icon"></span>  Nesting </a></li>  
        <li class="nav-item"><a class="nav-link" href="{{route('nesting_sequence.index')}}"><span class="nav-icon"></span>  Nesting Sequence </a></li>  
        <li class="nav-item"><a class="nav-link" href="{{route('sheet_nesting.index')}}"><span class="nav-icon"></span>  Dynamic Nesting Master </a></li>  
        <li class="nav-item"><a class="nav-link" href="{{route('child_part_unit_bom.index')}}"><span class="nav-icon"></span>  Child Part BOM </a></li>  
        <li class="nav-item"><a class="nav-link" href="{{route('process_master.index')}}"><span class="nav-icon"></span>  Process Master </a></li>  
        <li class="nav-item"><a class="nav-link" href="{{route('supplier.index')}}"><span class="nav-icon"></span> Supplier </a></li>  
      </ul>
    </li>
    @endif
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
      <svg class="nav-icon">
        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-library-building')}}"></use>
      </svg> Purchase </a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="{{route("purchase_order.index")}}"><span class="nav-icon"></span> Purchase Orders </a></li>      
      </ul>
    </li>
    @if(auth()->user()->id==3 || auth()->user()->id==1)
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
      <svg class="nav-icon">
        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-library-building')}}"></use>
      </svg> Stores</a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="{{route("store_receive.create")}}"><span class="nav-icon"></span> Store Receive RM </a></li>      
        <li class="nav-item"><a class="nav-link" href="{{route("store_issue.create")}}"><span class="nav-icon"></span> Store Issue RM </a></li>      
        <li class="nav-item"><a class="nav-link" href="{{route("store_issue.dc_issuance")}}"><span class="nav-icon"></span> DC Issuance </a></li>      
        <li class="nav-item"><a class="nav-link" href="{{route('store_receive_child_part.create')}}"><span class="nav-icon"></span> Store Receive Child Part </a></li>      
        <li class="nav-item"><a class="nav-link" href="#"><span class="nav-icon"></span> Store Issue Child Part </a></li>       
      </ul>
    </li>
    @endif
    @if(auth()->user()->id==4 || auth()->user()->id==1)
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
      <svg class="nav-icon">
        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass
        ')}}"></use>
      </svg> Quality </a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="{{route('good_received_note.index')}}"><span class="nav-icon"></span> GRN Approval </a></li>      
      </ul>
    </li>
    @endif
    {{-- REPORTS --}}
    @if (auth()->user()->id==2 || auth()->user()->id==1)
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
      <svg class="nav-icon">
        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-storage')}}"></use>
      </svg> Reports </a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="{{ route('store_receive.index') }}"><span class="nav-icon"></span> Store Transactions </a></li>      
        <li class="nav-item"><a class="nav-link" href="#"><span class="nav-icon"></span> Store Stock </a></li>      
        <li class="nav-item"><a class="nav-link" href="#"><span class="nav-icon"></span> Open Route Card Report </a></li>      
        <li class="nav-item"><a class="nav-link" href="#"><span class="nav-icon"></span> Closed Route Card Report </a></li>      
        <li class="nav-item"><a class="nav-link" href="#"><span class="nav-icon"></span> Quantity Accounting Report </a></li>      
      </ul>
    </li>
    @endif
    @if(auth()->user()->id==1)
    <li class="nav-item mt-auto"><a class="nav-link nav-link-danger" href="#" target="_top">
      <svg class="nav-icon">
        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-files"></use>
      </svg> DB Backup
    </a></li>
    @endif
    <li class="nav-item "><a class="nav-link" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
      <svg class="nav-icon">
        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-account-logout')}}"></use>
      </svg> Logout</a></li>
      <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

  </ul>