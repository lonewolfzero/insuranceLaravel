<style>
  #myBtn {
    display: none;
    position: fixed;
    bottom: 20px;
    left: 30px;
    z-index: 99;
    font-size: 14px;
    border: none;
    outline: none;
    background-color: white;
    color: darkblue;
    cursor: pointer;
    padding: 10px;
    border-radius: 4px;
  }

  #myBtn:hover {
    background-color: #555;
  }
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ url('/') }}" class="brand-link">
    <span class="brand-text font-weight-light text-light"><b>{{ config('app.name') }}</b></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu"
        data-accordion="false">
        @if (Auth::user()->role_id == 0)

        @else

        {{-- ANCHOR Dashboard Starts here --}}
        @if ($route_active == 'home')
        @php
        $home = 'active';
        $home_menu_open = 'menu-open';
        @endphp
        @else
        @php
        $home_menu_open = '';
        @endphp
        @endif

        <li class="nav-item">
          <a href="{{ url('home') }}" class="nav-link {{ @$home }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              {{ __('DASHBOARD') }}
            </p>
          </a>
        </li>

        {{-- (Auth::user()->role_id != 8 && Auth::user()->can('create-role')) --}}
        <!-- region  role  -->
        @can('viewany-role', User::class)
        @if ($route_active == 'users' || $route_active == 'roles' || $route_active == 'permissions')
        @php
        $users = 'active';
        $users_menu_open = 'menu-open';
        @endphp
        @else
        @php
        $users_menu_open = '';
        @endphp
        @endif
        <li class="nav-item has-treeview {{ @$users_menu_open }}">

          <a href="#" class="nav-link {{ @$users }}">
            <i class="nav-icon fas fa-users"></i>
            <p>

              <i class="right fas fa-angle-left"></i>
              {{ __('STAFF MANAGEMENT') }}
              <span class="badge badge-primary">{{ session('total_users') }}</span>
            </p>
          </a>

          <ul class="nav nav-treeview">
            @can('view-user', User::class)
            <li class="nav-item">
              @if ($route_active == 'users')
              @php $manage_users = 'active'; @endphp
              @endif
              <a href="{{ url('user') }}" class="nav-link {{ @$manage_users }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('STAFF USERS') }}</p>
              </a>
            </li>
            @endcan
            @can('view-role', User::class)
            <li class="nav-item">
              @if ($route_active == 'roles')
              @php $manage_roles = 'active'; @endphp
              @endif
              <a href="{{ url('user/role') }}" class="nav-link {{ @$manage_roles }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('ROLES') }}</p>
              </a>
            </li>
            @endcan
            {{-- Only Admin can access --}}
            @if (Auth::user()->role_id == '1')
            <li class="nav-item">
              @if ($route_active == 'permissions')
              @php $manage_permissions = 'active'; @endphp
              @endif
              <a href="{{ url('user/role/permissions') }}" class="nav-link {{ @$manage_permissions }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('PERMISSIONS') }}</p>
              </a>
            </li>
            @endif

          </ul>
        </li>
        @endcan
        <!-- end of region  role  -->

        <!-- region  contact  -->
        @can('viewany-user', User::class)
        @if (@$route_active == 'add_contact' || @$route_active == 'manage_contact' || @$route_active == 'show_contact')
        @php
        $contact_dd = 'active';
        $contact_menu_open = 'menu-open';
        @endphp
        @else
        @php
        $contact_menu_open = 'menu-close';
        @endphp
        @endif
        <li class="nav-item has-treeview {{ @$contact_menu_open }}">
          <a href="#" class="nav-link {{ @$contact_dd }}">
            <i class="nav-icon fas fa-user-shield"></i>
            <p>
              {{ __('CUSTOMERS') }}
              <i class="right fas fa-angle-left"></i>
              <span class="badge badge-primary">{{ session('total_customers') }}</span>
            </p>
          </a>

          <ul class="nav nav-treeview">

            @can('create-user', Auth::user())
            @if ($route_active == 'add_contact')
            @php
            $add_contact = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('customer/create') }}" class="nav-link {{ @$add_contact }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('NEW CUSTOMER') }}</p>
              </a>
            </li>
            @endcan

            @can('view-user', Auth::user())
            @if ($route_active == 'manage_contact' || $route_active == 'show_contact')
            @php
            $manage_contact = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('customer') }}" class="nav-link {{ @$manage_contact }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('CUSTOMERS') }}</p>
              </a>
            </li>
            @endcan
          </ul>
        </li>
        @endcan
        <!-- end of region  contact  -->



        {{-- @can('viewany-country', User::class) --}}
        @if (@$route_active == 'Country Master' ||
        @$route_active == 'State Master' ||
        @$route_active == 'City Master' ||
        @$route_active == 'Currency Master' ||
        @$route_active == 'Currency Exchange Master' ||
        @$route_active == 'Cause Of Loss Master' ||
        @$route_active == 'Claim Description Fee Master' ||
        @$route_active == 'Nature Of Loss Master' ||
        @$route_active == 'Surveyor Master' ||
        @$route_active == 'Fire & Engineering Lookup Location' ||
        @$route_active == 'Marine - Lookup Ship' ||
        @$route_active == 'Golf Field Hole' ||
        @$route_active == 'KOC Master' ||
        @$route_active == 'Ceding / Broker' ||
        @$route_active == 'COB Master' ||
        @$route_active == 'Occupation Master' ||
        @$route_active == 'Earthquake Zone' ||
        @$route_active == 'Flood Zone Master' ||
        @$route_active == 'Country Master' ||
        @$route_active == 'State Master' ||
        @$route_active == 'City Master' ||
        @$route_active == 'Ship Type Master' ||
        @$route_active == 'Classification Master' ||
        @$route_active == 'Construction Master' ||
        @$route_active == 'Company Type Master' ||
        @$route_active == 'Property Type Master' ||
        @$route_active == 'Condition Needed Master' ||
        @$route_active == 'Interest Insured Master' ||
        @$route_active == 'Extend Coverage Master' ||
        @$route_active == 'Deductible Type Master' ||
        @$route_active == 'Ship Port Master' ||
        @$route_active == 'Route Form Master' ||
        @$route_active == 'Insured Marine Type Master' ||
        @$route_active == 'Prefix Insured Master' ||
        @$route_active == 'Bank Master' ||
        @$route_active == 'Type Of Coverage Master' ||
        @$route_active == 'Type Of Mindep Master')
        @php
        $master_dd = 'active';
        $master_menu_open = 'menu-open';
        @endphp
        @else
        @php
        $master_menu_open = 'menu-close';
        @endphp
        @endif
        <li class="nav-item has-treeview {{ @$master_menu_open }}">
          <a href="#" class="nav-link {{ @$master_dd }}">
            <i class="nav-icon fas fa-laptop"></i>
            <p>
              {{ __('MASTER') }}
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            @can('create-permissionss', User::class)
            @if ($route_active == 'Permission')
            @php
            $permissionform = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/permission') }}" class="nav-link {{ @$permissionform }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('PERMISSION') }}</p>
              </a>
            </li>
            @endcan


            @can('create-cedingbroker', User::class)
            @if ($route_active == 'Ceding / Broker')
            @php
            $cedingform = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/cedingbroker') }}" class="nav-link {{ @$cedingform }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('CEDING/BROKER FORM') }}</p>
              </a>
            </li>
            @endcan


            @can('create-cause_of_loss', User::class)
            @if ($route_active == 'Cause Of Loss Master')
            @php
            $causeofloss = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/causeofloss') }}" class="nav-link {{ @$causeofloss }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('CAUSE OF LOSS FORM') }}</p>
              </a>
            </li>
            @endcan


            @can('create-cob', User::class)
            @if ($route_active == 'COB Master')
            @php
            $cob_form = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/cob') }}" class="nav-link {{ @$cob_form }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('COB FORM') }}</p>
              </a>
            </li>
            @endcan
            @if ($route_active == 'Business Type Master')
            @php
            $cob_form = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/business_type') }}" class="nav-link {{ @$cob_form }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('BUSINESS TYPE FORM') }}</p>
              </a>
            </li>
            @can('create-company_type', User::class)
            @if ($route_active == 'Company Type Master')
            @php
            $ctform = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/companytype') }}" class="nav-link {{ @$ctform }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('COMPANY TYPE FORM') }}</p>
              </a>
            </li>
            @endcan

            @can('create-condition_needed', User::class)
            @if ($route_active == 'Condition Needed Master')
            @php
            $cdn_form = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/conditionneeded') }}" class="nav-link {{ @$cdn_form }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('CONDITION NEEDED FORM') }}</p>
              </a>
            </li>
            @endcan

            @can('create-currency', User::class)
            @if ($route_active == 'Currency Master')
            @php
            $crc_form = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/currency') }}" class="nav-link {{ @$crc_form }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('CURRENCY FORM') }}</p>
              </a>
            </li>
            @endcan

            @can('create-exchange', User::class)
            @if ($route_active == 'Currency Exchange Master')
            @php
            $exchange_form = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/exchange') }}" class="nav-link {{ @$exchange_form }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('CURRENCY EXCHANGE') }}</p>
              </a>
            </li>
            @endcan

            @can('create-deductible', User::class)
            @if ($route_active == 'Deductible Type Master')
            @php
            $dt_form = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/deductibletype') }}" class="nav-link {{ @$dt_form }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('DEDUCTIBLE TYPE FORM') }}</p>
              </a>
            </li>
            @endcan

            @can('create-eqz', User::class)
            @if ($route_active == 'Earthquake Zone')
            @php
            $earthquakezone_form = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/earthquakezone') }}" class="nav-link {{ @$earthquakezone_form }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('EARTHQUAKE ZONE FORM') }}</p>
              </a>
            </li>
            @endcan

            @can('create-extend_coverage', User::class)
            @if ($route_active == 'Extend Coverage Master')
            @php
            $ec_form = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/extendedcoverage') }}" class="nav-link {{ @$ec_form }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('EXTEND COVERAGE FORM') }}</p>
              </a>
            </li>
            @endcan

            @can('create-fz', User::class)
            @if ($route_active == 'Flood Zone Master')
            @php
            $flood_form = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/floodzone') }}" class="nav-link {{ @$flood_form }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('FLOOD ZONE FORM') }}</p>
              </a>
            </li>
            @endcan

            @can('create-gfh', User::class)
            @if ($route_active == 'Golf Field Hole')
            @php
            $gfh_form = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/golffieldhole') }}" class="nav-link {{ @$gfh_form }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('GOLF FIELD HOLE') }}</p>
              </a>
            </li>
            @endcan

            @can('create-interest_insured', User::class)
            @if ($route_active == 'Interest Insured Master')
            @php
            $ii_form = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/interestinsured') }}" class="nav-link {{ @$ii_form }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('INTEREST INSURED FORM') }}</p>
              </a>
            </li>
            @endcan

            @can('create-koc', User::class)
            @if ($route_active == 'KOC Master')
            @php
            $koc_form = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/koc') }}" class="nav-link {{ @$koc_form }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('KIND OF CONTRACT') }}</p>
              </a>
            </li>
            @endcan

            @can('create-location_master', User::class)
            @if (@$route_active == 'Country Master' || @$route_active == 'State Master' || @$route_active == 'City
            Master')
            @php
            $location_dd = 'active';
            $location_menu_open = 'menu-open';
            @endphp
            @else
            @php
            $location_menu_open = 'menu-close';
            @endphp
            @endif
            <li class="nav-item has-treeview {{ @$location_menu_open }}">
              <a href="#" class="nav-link {{ @$location_dd }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  {{ __('LOCATION') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                @can('create-country', User::class)
                @if ($route_active == 'Country Master')
                @php
                $countryform = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/master-data/country') }}" class="nav-link {{ @$countryform }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('COUNTRY FORM') }}</p>
                  </a>
                </li>
                @endcan

                @can('create-state', User::class)
                @if ($route_active == 'State Master')
                @php
                $state_form = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/master-data/state') }}" class="nav-link {{ @$state_form }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('PROVINCE FORM') }}</p>
                  </a>
                </li>
                @endcan

                <!-- @can('viewany-city', User::class) -->
                @if ($route_active == 'City Master')
                @php
                $city_form = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/master-data/city') }}" class="nav-link {{ @$city_form }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('CITY FORM') }}</p>
                  </a>
                </li>
                <!-- @endcan -->
              </ul>
            </li>
            @endcan

            @can('create-felookup', User::class)
            @if ($route_active == 'Fire & Engineering Lookup Location')
            @php
            $felookuplocationform = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/felookuplocation') }}" class="nav-link {{ @$felookuplocationform }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('LOOKUP LOCATION') }}</p>
              </a>
            </li>
            @endcan

            @can('create-loss-desc', User::class)
            @if ($route_active == 'Claim Description Fee Master')
            @php
            $lossdescform = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/lossdesc') }}" class="nav-link {{ @$lossdescform }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('LOSS DESCRIPTION') }}</p>
              </a>
            </li>
            @endcan

            @can('create-marinelookup', User::class)
            @if ($route_active == 'Marine - Lookup Ship')
            @php
            $marinelookupform = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/marine-lookup') }}" class="nav-link {{ @$marinelookupform }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('MARINE - LOOKUP FORM') }}</p>
              </a>
            </li>
            @endcan

            @can('create-marine_master', User::class)
            @if (@$route_active == 'Ship Type Master' || @$route_active == 'Classification Master' || @$route_active ==
            'Construction Master')
            @php
            $marine_dd = 'active';
            $marine_menu_open = 'menu-open';
            @endphp
            @else
            @php
            $location_menu_open = 'menu-close';
            @endphp
            @endif
            <li class="nav-item has-treeview {{ @$marine_menu_open }}">
              <a href="#" class="nav-link {{ @$marine_dd }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  {{ __('MARINE MASTER') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                @can('create-shiptype', User::class)
                @if ($route_active == 'Ship Type Master')
                @php
                $shiptypeform = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/master-data/shiptype') }}" class="nav-link {{ @$shiptypeform }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('SHIP TYPE FORM') }}</p>
                  </a>
                </li>
                @endcan

                <!-- @can('create-classification', User::class) -->
                @if ($route_active == 'Classification Master')
                @php
                $classification_form = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/master-data/classification') }}" class="nav-link {{ @$classification_form }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('CLASSIFICATION FORM') }}</p>
                  </a>
                </li>
                <!-- @endcan -->

                <!-- @can('create-construction', User::class) -->
                @if ($route_active == 'Construction Master')
                @php
                $construction_form = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/master-data/construction') }}" class="nav-link {{ @$construction_form }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('CONSTRUCTION FORM') }}</p>
                  </a>
                </li>
                <!-- @endcan -->
              </ul>
            </li>
            @endcan

            @can('create-prefix_insured', User::class)
            @if ($route_active == 'Insured Marine Type Master')
            @php
            $insuredmarinetype = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/insuredmarinetype') }}" class="nav-link {{ @$insuredmarinetype }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('INSURED MARINE TYPE DATA') }}</p>
              </a>
            </li>
            @endcan

            @can('create-prefix_insured', User::class)
            @if ($route_active == 'Prefix Insured Master')
            @php
            $masterprefix = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/prefixinsured') }}" class="nav-link {{ @$masterprefix }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('PREFIX INSURED MASTER DATA') }}</p>
              </a>
            </li>
            @endcan


            @can('create-occupation', User::class)
            @if ($route_active == 'Occupation Master')
            @php
            $ocp_form = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/occupation') }}" class="nav-link {{ @$ocp_form }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('OCCUPATION FORM') }}</p>
              </a>
            </li>
            @endcan

            @can('create-property_type', User::class)
            @if ($route_active == 'Property Type Master')
            @php
            $property_form = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/propertytype') }}" class="nav-link {{ @$property_form }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('PROPERTY TYPE FORM') }}</p>
              </a>
            </li>
            @endcan

            @can('create-nature_of_loss', User::class)
            @if ($route_active == 'Nature Of Loss Master')
            @php
            $natureofloss = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/natureofloss') }}" class="nav-link {{ @$natureofloss }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('NATURE OF LOSS FORM') }}</p>
              </a>
            </li>
            @endcan

            @can('create-route', User::class)
            @if ($route_active == 'Route Form Master')
            @php
            $rf_form = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/routeform') }}" class="nav-link {{ @$rf_form }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('ROUTE FORM') }}</p>
              </a>
            </li>
            @endcan

            @can('create-ship_port', User::class)
            @if ($route_active == 'Ship Port Master')
            @php
            $sp_form = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/shipport') }}" class="nav-link {{ @$sp_form }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('SHIP PORT FORM') }}</p>
              </a>
            </li>
            @endcan

            @can('create-surveyor', User::class)
            @if ($route_active == 'Surveyor Master')
            @php
            $surveyor = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/surveyor') }}" class="nav-link {{ @$surveyor }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('SURVEYOR') }}</p>
              </a>
            </li>
            @endcan

            @can('create-bank', User::class)
            @if ($route_active == 'Bank Master')
            @php
            $bankform = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/bank') }}" class="nav-link {{ @$bankform }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('BANK') }}</p>
              </a>
            </li>
            @endcan

            @can('create-type-of-coverage', User::class)
            @if ($route_active == 'Type Of Coverage Master')
            @php
            $typeofcoverageform = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/typeofcoverage') }}" class="nav-link {{ @$typeofcoverageform }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('TYPE OF COVERAGE') }}</p>
              </a>
            </li>
            @endcan

            @can('create-type-of-mindep', User::class)
            @if ($route_active == 'Type Of Mindep Master')
            @php
            $typeofmindepform = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{ url('/master-data/typeofmindep') }}" class="nav-link {{ @$typeofmindepform }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{ __('TYPE OF MINDEP') }}</p>
              </a>
            </li>
            @endcan
          </ul>
        </li>
        {{-- @endcan --}}

        @canany([
        'create-fe_slip',
        'create-fl_slip',
        'create-hio_slip',
        'create-hem_slip',
        'create-mp_slip',
        'create-pa_slip',
        'create-marine_slip',
        ])
        @if (@$route_active == 'Marine - Slip Entry'
        || @$route_active == 'Marine Slip - Index'
        || @$route_active == 'Fire Engineering - Slip Entry'
        || @$route_active == 'Financial Lines - Slip Entry'
        || @$route_active == 'Moveable Property - Slip Entry'
        || @$route_active == 'Hole In One - Slip Entry'
        || @$route_active == 'Personal Accident - Slip Entry'
        || @$route_active == 'HE & Motor - Slip Entry'
        || @$route_active == 'Fire Engineering - Index'
        || @$route_active == 'Financial Lines - Index'
        || @$route_active == 'HE & Motor - Index'
        || @$route_active == 'Moveable Property - Index'
        || @$route_active == 'Hole In One - Index'
        || @$route_active == 'Personal Accident - Index'
        || @$route_active == 'Hole In One - Slip Entry'
        || @$route_active == 'Personal Accident - Entry'
        || @$route_active == 'Marine - Slip and Insured Details'
        || @$route_active == 'Marine Cargo - Slip Entry'
        || @$route_active == 'Marine Hull - Slip Entry')
        @php
        $trF_dd = 'active';
        $transaction_menu_open = 'menu-open';
        @endphp
        @else
        @php
        $transaction_menu_open = 'menu-close';
        @endphp
        @endif
        <li class="nav-item has-treeview {{ @$transaction_menu_open }}">

          <a href="#" class="nav-link {{ @$trF_dd }}">
            <i class="nav-icon fas fa-industry"></i>
            <p>
              {{ __('FACULTATIVE') }}
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>


          <ul class="nav nav-treeview">
            @can('create-fe_slip', User::class)
            @if (@$route_active == 'Fire Engineering - Slip Entry' || @$route_active == 'Fire Engineering - Index')
            @php
            $fed_dd = 'active';
            $fed_menu_open = 'menu-open';
            @endphp
            @else
            @php
            $fed_menu_open = 'menu-close';
            @endphp
            @endif
            <li class="nav-item has-treeview {{ @$fed_menu_open }}">
              <a href="#" class="nav-link {{ @$fed_dd }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  {{ __('FIRE & ENGINEERING') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                @if ($route_active == 'Fire Engineering - Index')
                @php
                $fes_formindex = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/transaction-data/fe/index') }}" class="nav-link {{ @$fes_formindex }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('FIRE & ENGINEERING -') }} <br>
                      {{ __('INDEX') }}</p>
                  </a>
                </li>

                @if ($route_active == 'Fire Engineering - Slip Entry')
                @php
                $fes_form = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/transaction-data/fe/entry') }}" class="nav-link {{ @$fes_form }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('FIRE & ENGINEERING -') }} <br>
                      {{ __(' SLIP ENTRY') }}</p>
                  </a>
                </li>
              </ul>
            </li>
            @endcan

            @can('create-fl_slip', User::class)
            @if (@$route_active == 'Financial Lines - Slip Entry' || @$route_active == 'Financial Lines - Index')
            @php
            $fld_dd = 'active';
            $fld_menu_open = 'menu-open';
            @endphp
            @else
            @php
            $fld_menu_open = 'menu-close';
            @endphp
            @endif
            <li class="nav-item has-treeview {{ @$fld_menu_open }}">
              <a href="#" class="nav-link {{ @$fld_dd }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  {{ __('FINANCIAL LINES') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                @if ($route_active == 'Financial Lines - Index')
                @php
                $flform = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/transaction-data/fl/index') }}" class="nav-link {{ @$flform }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('FINANCIAL LINES -') }} <br>
                      {{ __('INDEX') }}</p>
                  </a>
                </li>

                @if ($route_active == 'Financial Lines - Slip Entry')
                @php
                $fleform = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/transaction-data/fl/entry') }}" class="nav-link {{ @$fleform }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('FINANCIAL LINES -') }} <br>
                      {{ __('SLIP ENTRY') }}</p>
                  </a>
                </li>
              </ul>
            </li>
            @endcan

            @can('create-hem_slip', User::class)
            @if (@$route_active == 'HE & Motor - Slip Entry' || @$route_active == 'HE & Motor - Index')
            @php
            $hem_dd = 'active';
            $hem_menu_open = 'menu-open';
            @endphp
            @else
            @php
            $hem_menu_open = 'menu-close';
            @endphp
            @endif
            <li class="nav-item has-treeview {{ @$hem_menu_open }}">
              <a href="#" class="nav-link {{ @$hem_dd }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  {{ __('HE & MOTOR') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                @if ($route_active == 'HE & Motor - Index')
                @php
                $hem_form = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/transaction-data/hem/index') }}" class="nav-link {{ @$hem_form }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('HE & MOTOR - SLIP INDEX') }}</p>
                  </a>
                </li>

                @if ($route_active == 'HE & Motor - Slip Entry')
                @php
                $heme_form = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/transaction-data/hem/entry') }}" class="nav-link {{ @$heme_form }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('HE & MOTOR - SLIP ENTRY') }}</p>
                  </a>
                </li>
              </ul>
            </li>
            @endcan

            @can('create-mp_slip', User::class)
            @if (@$route_active == 'Moveable Property - Slip Entry' || @$route_active == 'Moveable Property - Index')
            @php
            $mpd_dd = 'active';
            $mpd_menu_open = 'menu-open';
            @endphp
            @else
            @php
            $mpd_menu_open = 'menu-close';
            @endphp
            @endif
            <li class="nav-item has-treeview {{ @$mpd_menu_open }}">
              <a href="#" class="nav-link {{ @$mpd_dd }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  {{ __('MOVEABLE PROPERTY') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if ($route_active == 'Moveable Property - Index')
                @php
                $mpe_form = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/transaction-data/mp/index') }}" class="nav-link {{ @$mpe_form }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('MOVEABLE PROPERTY -') }} <br>
                      {{ __('INDEX') }}</p>
                  </a>
                </li>

                @if ($route_active == 'Moveable Property - Slip Entry')
                @php
                $mp_form = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/transaction-data/mp/entry') }}" class="nav-link {{ @$mp_form }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('MOVEABLE PROPERTY -') }} <br>
                      {{ __('SLIP ENTRY') }}</p>
                  </a>
                </li>
              </ul>
            </li>
            @endcan

            @can('create-marine_slip', User::class)
            @if (@$route_active == 'Marine Cargo - Slip Entry' || @$route_active == 'Marine Slip - Index' ||
            @$route_active == 'Marine Hull - Slip Entry' || @$route_active == 'Marine - Slip and Insured Details')
            @php
            $ms_dd = 'active';
            $ms_menu_open = 'menu-open';
            @endphp
            @else
            @php
            $ms_menu_open = 'menu-close';
            @endphp
            @endif
            <li class="nav-item has-treeview {{ @$ms_menu_open }}">
              <a href="#" class="nav-link {{ @$ms_dd }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  {{ __('MARINE') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if ($route_active == 'Marine Slip - Index')
                @php
                $ms_formindex = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/transaction-data/marine-index') }}" class="nav-link {{ @$ms_formindex }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('MARINE SLIP - INDEX') }}</p>
                  </a>
                </li>

                @if ($route_active == 'Marine Cargo - Slip Entry')
                @php
                $ms_form = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/transaction-data/marine-slip') }}" class="nav-link {{ @$ms_form }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('MARINE CARGO - SLIP ENTRY') }}</p>
                  </a>
                </li>

                @if ($route_active == 'Marine Hull - Slip Entry')
                @php
                $mh_form = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/transaction-data/marine-hull-slip') }}" class="nav-link {{ @$mh_form }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('MARINE HULL - SLIP ENTRY') }}</p>
                  </a>
                </li>
              </ul>
            </li>
            @endcan

            @can('create-hio_slip', User::class)
            @if (@$route_active == 'Hole In One - Slip Entry' || @$route_active == 'Hole In One - Index')
            @php
            $hio_dd = 'active';
            $hio_menu_open = 'menu-open';
            @endphp
            @else
            @php
            $hio_menu_open = 'menu-close';
            @endphp
            @endif
            <li class="nav-item has-treeview {{ @$hio_menu_open }}">
              <a href="#" class="nav-link {{ @$hio_dd }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  {{ __('HOLE IN ONE') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if ($route_active == 'Hole In One - Index')
                @php
                $hio_idx = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/transaction-data/hio/index') }}" class="nav-link {{ @$hio_idx }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('HOLE IN ONE - INDEX') }}</p>
                  </a>
                </li>

                @if ($route_active == 'Hole In One - Slip Entry')
                @php
                $hio_form = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/transaction-data/hio/entry') }}" class="nav-link {{ @$hio_form }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('HOLE IN ONE - SLIP ENTRY') }}</p>
                  </a>
                </li>
              </ul>
            </li>
            @endcan

            @can('create-pa_slip', User::class)
            @if (@$route_active == 'Personal Accident - Slip Entry' || @$route_active == 'Personal Accident - Index')
            @php
            $pa_dd = 'active';
            $pa_menu_open = 'menu-open';
            @endphp
            @else
            @php
            $pa_menu_open = 'menu-close';
            @endphp
            @endif
            <li class="nav-item has-treeview {{ @$pa_menu_open }}">
              <a href="#" class="nav-link {{ @$pa_dd }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  {{ __('PERSONAL ACCIDENT') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if ($route_active == 'Personal Accident - Index')
                @php
                $pa_idx = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/transaction-data/pa/index') }}" class="nav-link {{ @$pa_idx }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('PERSONAL ACCIDENT - INDEX') }}</p>
                  </a>
                </li>

                @if ($route_active == 'Personal Accident - Slip Entry')
                @php
                $pa_form = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/transaction-data/pa/entry') }}" class="nav-link {{ @$pa_form }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;"> {{ __('PERSONAL ACCIDENT -') }} <br>
                      {{ __('SLIP ENTRY') }}</p>
                  </a>
                </li>
              </ul>
            </li>
            @endcan

          </ul>
        </li>
        @endcanany

        @canany([
        'create-claim-fe',
        'create-claim-fl',
        'create-claim-hio',
        'create-claim-hem',
        'create-claim-mp',
        'create-claim-pa',
        'create-claim-marine',
        'create-claim-agendace',
        ])
        @if (strpos($route_active, 'CLAIM') !== false)
        @php
        $trF_ddclaim = 'active';
        $transactionclaim_menu_open = 'menu-open';
        @endphp
        @else
        @php
        $transactionclaim_menu_open = 'menu-close';
        @endphp
        @endif
        <li class="nav-item has-treeview {{ @$transactionclaim_menu_open }}">

          <a href="#" class="nav-link {{ @$trF_ddclaim }}">
            <i class="nav-icon fas fa-industry"></i>
            <p>
              {{ __('CLAIM') }}
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">

            {{-- ADD ANOTHER MODULE HERE BY ADDING ELSEIF --}}
            @if (strpos(@$route_active, 'CLAIM FIRE & ENGINEERING') > -1)
            @php
            $claim_ddfe = 'active';
            $claim_menu_openfe = 'menu-open';
            @endphp
            @elseif (strpos(@$route_active, 'CLAIM MARINE') > -1)
            @php
            $claim_ddmarine = 'active';
            $claim_menu_openmarine = 'menu-open';
            @endphp
            @elseif (strpos(@$route_active, 'CLAIM FINANCIAL LINES') > -1)
            @php
            $claim_ddfl = 'active';
            $claim_menu_openfl = 'menu-open';
            @endphp
            @elseif (strpos(@$route_active, 'CLAIM HE & MOTOR') > -1)
            @php
            $claim_ddhem = 'active';
            $claim_menu_openhem = 'menu-open';
            @endphp
            @elseif (strpos(@$route_active, 'CLAIM MOVEABLE PROPERTY') > -1)
            @php
            $claim_ddmp = 'active';
            $claim_menu_openmp = 'menu-open';
            @endphp
            @elseif (strpos(@$route_active, 'CLAIM HOLE IN ONE') > -1)
            @php
            $claim_ddhio = 'active';
            $claim_menu_openhio = 'menu-open';
            @endphp
            @elseif (strpos(@$route_active, 'CLAIM PERSONAL ACCIDENT') > -1)
            @php
            $claim_ddpa = 'active';
            $claim_menu_openpa = 'menu-open';
            @endphp
            @elseif (strpos(@$route_active, 'AGENDA CE') > -1)
            @php
            $claim_menu_openagenda = 'menu-open';
            $claim_ddagenda = 'active';
            @endphp
            @else
            @php
            $claim_menu_openfe = 'menu-close';
            $claim_menu_openfl = 'menu-close';
            $claim_menu_openhem = 'menu-close';
            $claim_menu_openmp = 'menu-close';
            $claim_menu_openmarine = 'menu-close';
            $claim_menu_openhio = 'menu-close';
            $claim_menu_openpa = 'menu-close';
            $claim_menu_openagenda = 'menu-close';
            @endphp
            @endif

            @canany([
            'create-claim-fe',
            'view-claim-fe',
            ])
            <li class="nav-item has-treeview {{ @$claim_menu_openfe }}">
              <a href="#" class="nav-link {{ @$claim_ddfe }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  {{ __('FIRE & ENGINEERING') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                @can('view-claim-fe', User::class)
                @if ($route_active == 'CLAIM FIRE & ENGINEERING - Index')
                @php
                $claim_formindexfe = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/claimtransaction-data/fe/index') }}" class="nav-link {{ @$claim_formindexfe }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('FIRE & ENGINEERING') }} <br> {{ __('INDEX') }}
                    </p>
                  </a>
                </li>
                @endcan

                @can('create-claim-fe', User::class)
                @if ($route_active == 'CLAIM FIRE & ENGINEERING - Entry')
                @php
                $claim_formfe = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/claimtransaction-data/fe/entry') }}" class="nav-link {{ @$claim_formfe }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('FIRE & ENGINEERING') }} <br> {{ __('ENTRY') }}
                    </p>
                  </a>
                </li>
                @endcan
              </ul>
            </li>
            @endcanany

            @canany([
            'create-claim-fl',
            'view-claim-fl',
            ])
            <li class="nav-item has-treeview {{ @$claim_menu_openfl }}">
              <a href="#" class="nav-link {{ @$claim_ddfl }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  {{ __('FINANCIAL LINES') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                @can('view-claim-fl', User::class)
                @if ($route_active == 'CLAIM FINANCIAL LINES - Index')
                @php
                $claim_formindexfl = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/claimtransaction-data/fl/index') }}" class="nav-link {{ @$claim_formindexfl }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('FINANCIAL LINES') }} <br> {{ __('INDEX') }}
                    </p>
                  </a>
                </li>
                @endcan

                @can('create-claim-fl', User::class)
                @if ($route_active == 'CLAIM FINANCIAL LINES - Entry')
                @php
                $claim_formfl = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/claimtransaction-data/fl/entry') }}" class="nav-link {{ @$claim_formfl }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('FINANCIAL LINES') }} <br> {{ __('ENTRY') }}
                    </p>
                  </a>
                </li>
                @endcan
              </ul>
            </li>
            @endcanany

            @canany([
            'create-claim-hem',
            'view-claim-hem',
            ])
            <li class="nav-item has-treeview {{ @$claim_menu_openhem }}">
              <a href="#" class="nav-link {{ @$claim_ddhem }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  {{ __('HE & MOTOR') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                @can('view-claim-hem', User::class)
                @if ($route_active == 'CLAIM HE & MOTOR - Index')
                @php
                $claim_formindexhem = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/claimtransaction-data/hem/index') }}" class="nav-link {{ @$claim_formindexhem }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('HE & MOTOR') }} <br> {{ __('INDEX') }}
                    </p>
                  </a>
                </li>
                @endcan

                @can('create-claim-hem', User::class)
                @if ($route_active == 'CLAIM HE & MOTOR - Entry')
                @php
                $claim_formhem = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/claimtransaction-data/hem/entry') }}" class="nav-link {{ @$claim_formhem }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('HE & MOTOR') }} <br> {{ __('ENTRY') }}
                    </p>
                  </a>
                </li>
                @endcan
              </ul>
            </li>
            @endcanany

            @canany([
            'create-claim-mp',
            'view-claim-mp',
            ])
            <li class="nav-item has-treeview {{ @$claim_menu_openmp }}">
              <a href="#" class="nav-link {{ @$claim_ddmp }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  {{ __('MOVEABLE PROPERTY') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                @can('view-claim-mp', User::class)
                @if ($route_active == 'CLAIM MOVEABLE PROPERTY - Index')
                @php
                $claim_formindexmp = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/claimtransaction-data/mp/index') }}" class="nav-link {{ @$claim_formindexmp }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('MOVEABLE PROPERTY') }} <br> {{ __('INDEX') }}
                    </p>
                  </a>
                </li>
                @endcan

                @can('create-claim-mp', User::class)
                @if ($route_active == 'CLAIM MOVEABLE PROPERTY - Entry')
                @php
                $claim_formmp = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/claimtransaction-data/mp/entry') }}" class="nav-link {{ @$claim_formmp }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('MOVEABLE PROPERTY') }} <br> {{ __('ENTRY') }}
                    </p>
                  </a>
                </li>
                @endcan
              </ul>
            </li>
            @endcanany

            @canany([
            'create-claim-marine',
            'view-claim-marine',
            ])
            <li class="nav-item has-treeview {{ @$claim_menu_openmarine }}">
              <a href="#" class="nav-link {{ @$claim_ddmarine }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  {{ __('MARINE') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                @can('view-claim-marine', User::class)
                @if (@$route_active == 'CLAIM MARINE - Index')
                @php
                @$claim_formindexmarine = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/claimtransaction-data/marine/index') }}"
                    class="nav-link {{ @$claim_formindexmarine }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('MARINE CLAIM - INDEX') }}
                    </p>
                  </a>
                </li>
                @endcan

                @can('create-claim-marine', User::class)
                @if (@$route_active == 'CLAIM MARINE CARGO - Entry' || @$route_active == 'CLAIM MARINE CARGO - update')
                @php
                @$claim_formcargo = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/claimtransaction-data/mc/entry') }}" class="nav-link {{ @$claim_formcargo }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('MARINE CARGO - CLAIM ENTRY') }}
                    </p>
                  </a>
                </li>
                @if (@$route_active == 'CLAIM MARINE HULL - Entry' || @$route_active == 'CLAIM MARINE HULL - update')
                @php
                @$claim_formhull = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/claimtransaction-data/mh/entry') }}" class="nav-link {{ @$claim_formhull }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('MARINE HULL - CLAIM ENTRY') }}
                    </p>
                  </a>
                </li>
                @endcan
              </ul>
            </li>
            @endcanany

            @canany([
            'create-claim-hio',
            'view-claim-hio',
            ])
            <li class="nav-item has-treeview {{ @$claim_menu_openhio }}">
              <a href="#" class="nav-link {{ @$claim_ddhio }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  {{ __('HOLE IN ONE') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                @can('view-claim-hio', User::class)
                @if ($route_active == 'CLAIM HOLE IN ONE - Index')
                @php
                $claim_formindexhio = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/claimtransaction-data/hio/index') }}" class="nav-link {{ @$claim_formindexhio }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('HOLE IN ONE') }} <br> {{ __('INDEX') }}
                    </p>
                  </a>
                </li>
                @endcan

                @can('create-claim-hio', User::class)
                @if ($route_active == 'CLAIM HOLE IN ONE - Entry')
                @php
                $claim_formhio = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/claimtransaction-data/hio/entry') }}" class="nav-link {{ @$claim_formhio }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('HOLE IN ONE') }} <br> {{ __('ENTRY') }}
                    </p>
                  </a>
                </li>
                @endcan
              </ul>
            </li>
            @endcanany

            @canany([
            'create-claim-pa',
            'view-claim-pa',
            ])
            <li class="nav-item has-treeview {{ @$claim_menu_openpa }}">
              <a href="#" class="nav-link {{ @$claim_ddpa }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  {{ __('PERSONAL ACCIDENT') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                @can('view-claim-pa', User::class)
                @if ($route_active == 'CLAIM PERSONAL ACCIDENT - Index')
                @php
                $claim_formindexpa = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/claimtransaction-data/pa/index') }}" class="nav-link {{ @$claim_formindexpa }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('PERSONAL ACCIDENT') }} <br> {{ __('INDEX') }}
                    </p>
                  </a>
                </li>
                @endcan

                @can('create-claim-pa', User::class)
                @if ($route_active == 'CLAIM PERSONAL ACCIDENT - Entry')
                @php
                $claim_formpa = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/claimtransaction-data/pa/entry') }}" class="nav-link {{ @$claim_formpa }}">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;">{{ __('PERSONAL ACCIDENT') }} <br> {{ __('ENTRY') }}
                    </p>
                  </a>
                </li>
                @endcan
              </ul>
            </li>
            @endcanany

            @can('view-claim-agendace', User::class)
            <li class="nav-item has-treeview {{ @$claim_menu_openagenda }}">
              <a href="{{ url('/claimtransaction-data/agendace') }}" class="nav-link {{ @$claim_ddagenda }}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  {{ __('AGENDA CE') }}
                  {{-- <i class="right fas fa-angle-left"></i> --}}
                </p>
              </a>
            </li>
            @endcan

          </ul>
        </li>
        @endcanany

        @if (strpos($route_active, 'TREATY') !== false)
        @php
        $trF_ddtreaty = 'active';
        $treaty_menu_open = 'menu-open';
        @endphp
        @else
        @php
        $treaty_menu_open = 'menu-close';
        @endphp
        @endif

        <li class="nav-item has-treeview {{ @$treaty_menu_open }}">

          <a href="#" class="nav-link {{ @$trF_ddtreaty }}">
            <i class="nav-icon fas fa-industry"></i>
            <p>
              {{ __('TREATY') }}
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            @if (strpos(@$route_active, 'TREATY & RETROCESSION Summary Prop') > -1)
            @php
            $treaty_ddprop = 'active';
            $treaty_menu_openprop = 'menu-open';
            @endphp
            @elseif (strpos(@$route_active, 'TREATY | Sliding Scale') > -1)
            @php
            $treaty_ddss = 'active';
            $treaty_menu_openss = 'menu-open';
            @endphp
            @elseif (strpos(@$route_active, 'TREATY | Statement Of Account') > -1)
            @php
            $treaty_ddsoa = 'active';
            $treaty_menu_opensoa = 'menu-open';
            @endphp
            @elseif (strpos(@$route_active, 'TREATY | Profit Commission') > -1)
            @php
            $treaty_ddpc = 'active';
            $treaty_menu_openpc = 'menu-open';
            @endphp
            @elseif (strpos(@$route_active, 'TREATY | Loss Participation') > -1)
            @php
            $treaty_ddlp = 'active';
            $treaty_menu_openlp = 'menu-open';
            @endphp
            @elseif (strpos(@$route_active, 'TREATY | Accumulation Control') > -1)
            @php
            $treaty_ddac = 'active';
            $treaty_menu_openac = 'menu-open';
            @endphp
            @elseif (strpos(@$route_active, 'TREATY & RETROCESSION Summary Non Prop') > -1)
            @php
            $treaty_ddnonprop = 'active';
            $treaty_menu_opennonprop = 'menu-open';
            @endphp
            @elseif (strpos(@$route_active, 'TREATY | Profit Sharing') > -1)
            @php
            $treaty_ddps = 'active';
            $treaty_menu_openps = 'menu-open';
            @endphp
            @elseif (strpos(@$route_active, 'TREATY | Transfer Form') > -1)
            @php
            $treaty_ddtf = 'active';
            $treaty_menu_opentf = 'menu-open';
            @endphp
            @else
            @php
            $treaty_menu_openprop = 'menu-close';
            @endphp
            @endif
            <li class="nav-item has-treeview {{ @$treaty_menu_openprop }}">
              <a href="#" class="nav-link {{ @$treaty_ddprop }} d-flex align-items-center">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%; text-transform: uppercase"> {{ __('TREATY & RETROCESSION') }}
                  <i class="right fas fa-angle-left"></i> <br> {{ __('Summary Prop') }}
                </p>
              </a>

              <ul class="nav nav-treeview">
                @if ($route_active == 'TREATY & RETROCESSION Summary Prop - List')
                @php
                $treaty_listprop = 'active';
                @endphp
                @elseif($route_active == 'TREATY & RETROCESSION Summary Prop - Entry')
                @php
                $treaty_entryprop = 'active';
                @endphp
                @elseif($route_active == 'TREATY & RETROCESSION Summary Prop Credit - Entry')
                @php
                $treaty_creditprop = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/treaty/prop/list') }}"
                    class="nav-link {{ @$treaty_listprop }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('TREATY & RETROCESSION') }}
                      <br>
                      {{ __('Summary Prop') }} <br> {{ __('LIST') }}
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('/treaty/prop/entry') }}"
                    class="nav-link {{ @$treaty_entryprop }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('TREATY & RETROCESSION') }}
                      <br>
                      {{ __('Summary Prop') }} <br>
                      {{ __('ENTRY') }}
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('/treaty/prop/credit/entry') }}"
                    class="nav-link {{ @$treaty_creditprop }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('TREATY & RETROCESSION') }}
                      <br>
                      {{ __('Summary Prop Credit') }} <br>
                      {{ __('ENTRY') }}
                    </p>
                  </a>
                </li>
              </ul>

            </li>

            <li class="nav-item has-treeview {{ @$treaty_menu_openss }}">
              <a href="#" class="nav-link {{ @$treaty_ddss }} d-flex align-items-center">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  <p style="text-transform: uppercase"> {{ __('Sliding Scale') }}
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if ($route_active == 'TREATY | Sliding Scale')
                @php
                $treaty_listss = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/treaty/sliding') }}"
                    class="nav-link {{ @$treaty_listss }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%;  text-transform: uppercase">
                      {{ __('Sliding Scale Commission') }} <br> {{ __('Form') }}
                    </p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item has-treeview {{ @$treaty_menu_opensoa }}">
              <a href="#" class="nav-link {{ @$treaty_ddsoa }} d-flex align-items-center">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  <p style="text-transform: uppercase"> {{ __('Statement Of Account') }}
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </p>
              </a>

              <ul class="nav nav-treeview">
                @if ($route_active == 'TREATY | Statement Of Account - List')
                @php
                $soa_list = 'active';
                @endphp
                @elseif($route_active == 'TREATY | Statement Of Account - Entry')
                @php
                $soa_entry = 'active';
                @endphp
                @elseif($route_active == 'TREATY | Statement Of Account Registration - List')
                @php
                $soa_registration_list = 'active';
                @endphp
                @elseif($route_active == 'TREATY | Statement Of Account Nil Reminder - List')
                @php
                $soanil_list = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/treaty/soa/list') }}" class="nav-link {{ @$soa_list }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">{{ __('Statement Of Account') }}
                      <br> {{ __('LIST') }}
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('/treaty/soa/entry') }}" class="nav-link {{ @$soa_entry }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">{{ __('Statement Of Account') }}
                      <br>
                      {{ __('ENTRY') }}
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('/treaty/soa/registration/list') }}"
                    class="nav-link {{ @$soa_registration_list }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('Registration') }} <br>
                      {{ __('LIST') }}
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('/treaty/soa/nil/list') }}"
                    class="nav-link {{ @$soanil_list }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">{{ __('Statement Of Account') }}
                      <br>
                      {{ __('Nil Reminder') }} <br>
                      {{ __('LIST') }}
                    </p>
                  </a>
                </li>
              </ul>

            </li>

            <li class="nav-item has-treeview {{ @$treaty_menu_openpc }}">
              <a href="#" class="nav-link {{ @$treaty_ddpc }} d-flex align-items-center">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  <p style="text-transform: uppercase"> {{ __('Profit Commission') }}
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </p>
              </a>

              <ul class="nav nav-treeview">
                @if ($route_active == 'TREATY | Profit Commission - List')
                @php
                $pc_list = 'active';
                @endphp
                @elseif($route_active == 'TREATY | Profit Commission - Entry')
                @php
                $pc_entry = 'active';
                @endphp
                @elseif($route_active == 'TREATY | Profit Commission Registration - List')
                @php
                $pc_regist = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/treaty/commission/list') }}"
                    class="nav-link {{ @$pc_list }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">{{ __('Profit Commission') }}
                      <br> {{ __('LIST') }}
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('/treaty/commission/entry') }}"
                    class="nav-link {{ @$pc_entry }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">{{ __('Profit Commission') }}
                      <br>
                      {{ __('ENTRY') }}
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('/treaty/commission/registration/list') }}"
                    class="nav-link {{ @$pc_regist }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('Registration') }}<br>
                      {{ __('LIST') }}
                    </p>
                  </a>
                </li>
              </ul>

            </li>

            <li class="nav-item has-treeview {{ @$treaty_menu_openlp }}">
              <a href="#" class="nav-link {{ @$treaty_ddlp }} d-flex align-items-center">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  <p style="text-transform: uppercase"> {{ __('Loss Participation') }}
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </p>
              </a>

              <ul class="nav nav-treeview">
                @if ($route_active == 'TREATY | Loss Participation - List')
                @php
                $lp_list = 'active';
                @endphp
                @elseif($route_active == 'TREATY | Loss Participation - Entry')
                @php
                $lp_entry = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/treaty/loss/list') }}" class="nav-link {{ @$lp_list }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('Loss Participation') }}
                      <br> {{ __('LIST') }}
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('/treaty/loss/entry') }}" class="nav-link {{ @$lp_entry }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('Loss Participation') }}
                      <br>
                      {{ __('ENTRY') }}
                    </p>
                  </a>
                </li>
              </ul>

            </li>

            <li class="nav-item has-treeview {{ @$treaty_menu_openac }}">
              <a href="#" class="nav-link {{ @$treaty_ddac }} d-flex align-items-center">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  <p style="text-transform: uppercase"> {{ __('Accumulation Control') }}
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </p>
              </a>

              <ul class="nav nav-treeview">
                @if ($route_active == 'TREATY | Accumulation Control - List')
                @php
                $ac_list = 'active';
                @endphp
                @elseif($route_active == 'TREATY | Accumulation Control - Entry')
                @php
                $ac_entry = 'active';
                @endphp
                @elseif($route_active == 'TREATY | Accumulation Control - Upload')
                @php
                $ac_upload = 'active';
                @endphp
                @elseif($route_active == 'TREATY | Accumulation Control - Portfolio Form')
                @php
                $ac_protfolio = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/treaty/acc/list') }}" class="nav-link {{ @$ac_list }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('Accumulation Control') }}
                      <br> {{ __('LIST') }}
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('/treaty/acc/entry') }}" class="nav-link {{ @$ac_entry }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('Accumulation Control') }}
                      <br>
                      {{ __('ENTRY') }}
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('/treaty/acc/upload') }}"
                    class="nav-link {{ @$ac_upload }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('Accumulation Control') }}
                      <br>
                      {{ __('UPLOAD') }}
                    </p>
                  </a>
                </li>

                <!--li class="nav-item">
                <a href="{{ url('/treaty/acc/portofolio') }}"
                  class="nav-link {{ @$ac_protfolio }} d-flex align-items-center">
                  <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                  <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                    {{ __('Portfolio Form') }}
                  </p>
                </a>
              </li-->

              </ul>

            </li>

            <li class="nav-item has-treeview {{ @$treaty_menu_opennonprop }}">
              <a href="#" class="nav-link {{ @$treaty_ddnonprop }} d-flex align-items-center">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  <p class="text-transform: uppercase"> {{ __('TREATY & RETROCESSION') }} <i
                      class="right fas fa-angle-left"></i> <br>
                    {{ __('Summary Non Prop') }}
                  </p>
                </p>
              </a>

              <ul class="nav nav-treeview">
                @if ($route_active == 'TREATY & RETROCESSION Summary Non Prop - List')
                @php
                $treaty_listnonprop = 'active';
                @endphp
                @elseif($route_active == 'TREATY & RETROCESSION Summary Non Prop Mindep - Entry')
                @php
                $treaty_entrynonprop = 'active';
                @endphp
                @elseif($route_active == 'TREATY & RETROCESSION Summary Non Prop Adj Mindep - Entry')
                @php
                $treaty_mindepnonprop = 'active';
                @endphp
                @elseif($route_active == 'TREATY & RETROCESSION Summary Non Prop Reinstatement - Entry')
                @php
                $treaty_reinsprop = 'active';
                @endphp
                @elseif($route_active == 'TREATY & RETROCESSION Summary Non Prop Adj Reinstatement - Entry')
                @php
                $treaty_adj_reinsprop = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/treaty/nonprop/list') }}"
                    class="nav-link {{ @$treaty_listnonprop }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('TREATY & RETROCESSION') }}
                      <br>
                      {{ __('Summary Non Prop') }} <br> {{ __('LIST') }}
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('/treaty/nonprop/entry') }}"
                    class="nav-link {{ @$treaty_entrynonprop }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('TREATY & RETROCESSION') }}
                      <br>
                      {{ __('Summary Non Prop') }} <br>
                      {{ __('ENTRY') }}
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('/treaty/nonprop/mindep/entry') }}"
                    class="nav-link {{ @$treaty_mindepnonprop }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('TREATY & RETROCESSION') }}
                      <br>
                      {{ __('Summary Non Prop Adj Mindep') }} <br>
                      {{ __('List') }}
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('/treaty/nonprop/reinstatement/entry') }}"
                    class="nav-link {{ @$treaty_reinsprop }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('TREATY & RETROCESSION') }}
                      <br>
                      {{ __('Summary Non Prop') }} <br>
                      {{ __('Reinstatement List') }}
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('/treaty/nonprop/reinstatement/adj/entry') }}"
                    class="nav-link {{ @$treaty_adj_reinsprop }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('TREATY & RETROCESSION') }}
                      <br>
                      {{ __('Summary Non Prop Adj') }} <br>
                      {{ __('Reinstatement List') }}
                    </p>
                  </a>
                </li>

              </ul>

            </li>

            <li class="nav-item has-treeview {{ @$treaty_menu_openps }}">
              <a href="#" class="nav-link {{ @$treaty_ddps }} d-flex align-items-center">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  <p style="text-transform: uppercase"> {{ __('Profit Sharing') }} <i
                      class="right fas fa-angle-left"></i>
                  </p>
                </p>
              </a>

              <ul class="nav nav-treeview">
                @if ($route_active == 'TREATY | Profit Sharing - List')
                @php
                $ps_list = 'active';
                @endphp
                @elseif($route_active == 'TREATY | Profit Sharing - Entry')
                @php
                $ps_entry = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/treaty/sharing/list') }}"
                    class="nav-link {{ @$ps_list }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('Profit Sharing') }}
                      <br> {{ __('LIST') }}
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('/treaty/sharing/entry') }}"
                    class="nav-link {{ @$ps_entry }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('Profit Sharing') }}
                      <br>
                      {{ __('ENTRY') }}
                    </p>
                  </a>
                </li>
              </ul>

            </li>

            <!--li class="nav-item has-treeview {{ @$treaty_menu_opentf }}">
              <a href="#" class="nav-link {{ @$treaty_ddtf }} d-flex align-items-center">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">
                  <p style="text-transform: uppercase"> {{ __('Transfer Form') }} <i
                      class="right fas fa-angle-left"></i>
                  </p>
                </p>
              </a>

              <ul class="nav nav-treeview">
                @if ($route_active == 'TREATY | Transfer Form - Transfer Form')
                @php
                $tf_list = 'active';
                @endphp
                @elseif($route_active == 'TREATY | Transfer Form - Bukti Transfer Prop')
                @php
                $tf_prop = 'active';
                @endphp
                @elseif($route_active == 'TREATY | Transfer Form - Bukti Transfer Non Prop')
                @php
                $tf_non_prop = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/treaty/transfer') }}" class="nav-link {{ @$tf_list }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('Transfer Form') }}
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('/treaty/transfer/prop') }}"
                    class="nav-link {{ @$tf_prop }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('Bukti Transfer Prop') }}
                      <br> {{ __('LIST') }}
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('/treaty/transfer/nonprop') }}"
                    class="nav-link {{ @$tf_non_prop }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('Bukti Transfer Non Prop') }}
                      <br>
                      {{ __('LIST') }}
                    </p>
                  </a>
                </li>
              </ul>

            </li-->

          </ul>

        </li>

        @if (strpos($route_active, 'retro') !== false)
        @php
        $retro_main = 'active';
        $retro_menu = 'menu-open';
        @endphp
        @else
        @php
        $retro_menu = 'menu-close';
        @endphp
        @endif

        <li class="nav-item has-treeview {{ @$retro_menu }}">

          <a href="#" class="nav-link {{ @$retro_main }}">
            <i class="nav-icon fas fa-industry"></i>
            <p>
              {{ __('RETRO') }}
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            @if (strpos(@$route_active, 'retro - mindep') > -1)
            @php
            $retro_sub_mindep = 'active';
            $retro_sub_mindepopen = 'menu-open';
            @endphp
            @endif
            <li class="nav-item has-treeview {{ @$retro_sub_mindepopen }}">
              <a href="#" class="nav-link {{ @$retro_sub_mindep }} d-flex align-items-center">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%; text-transform: uppercase"> {{ __('retro mindep') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                @if ($route_active == 'retro - mindep entry list')
                @php
                $retro_entry_list = 'active';
                @endphp
                @elseif($route_active == 'retro - mindep adjusment list')
                @php
                $retro_adjusment_list = 'active';
                @endphp
                @elseif($route_active == 'retro - mindep entry')
                @php
                $retro_entry = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/retro/mindep/list') }}"
                    class="nav-link {{ @$retro_entry_list }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('RETROCESSION ENTRY') }}
                      <br> {{ __('LIST') }}
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('/retro/mindep/entry') }}"
                    class="nav-link {{ @$retro_entry }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('RETROCESSION') }}
                      <br> {{ __('ENTRY') }}
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('/retro/mindep/adjusment/list') }}"
                    class="nav-link {{ @$retro_adjusment_list }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      {{ __('RETROCESSION ADJUSMENT') }}
                      <br> {{ __('LIST') }}
                    </p>
                  </a>
                </li>
              </ul>

            </li>

          </ul>

          <ul class="nav nav-treeview">
            @if (strpos(@$route_active, 'retro - contract') > -1)
            @php
            $retro_sub_contract = 'active';
            $retro_sub_contractopen = 'menu-open';
            @endphp
            @endif
            <li class="nav-item has-treeview {{ @$retro_sub_contractopen }}">
              <a href="#" class="nav-link {{ @$retro_sub_contract }} d-flex align-items-center">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%; text-transform: uppercase"> {{ __('retro special contract') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                @if ($route_active == 'retro - contract entry')
                @php
                $retro_contract_entry = 'active';
                @endphp
                @elseif($route_active == 'retro - contract list')
                @php
                $retro_contract_list = 'active';
                @endphp
                @endif
                <li class="nav-item">
                  <a href="{{ url('/retro/contract/entry') }}"
                    class="nav-link {{ @$retro_contract_entry }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      RETROCESSION <br> SPECIAL CONTRACT <br> ENTRY
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('/retro/contract/list') }}"
                    class="nav-link {{ @$retro_contract_list }} d-flex align-items-center">
                    <i class="far fa-folder nav-icon text-secondary" style="margin-left:14%;"></i>
                    <p style="font-size: 80%;margin-left:2%; text-transform: uppercase">
                      RETROCESSION <br> SPECIAL CONTRACT <br> LIST
                    </p>
                  </a>
                </li>
              </ul>

            </li>

          </ul>

        </li>


        @endif




        <!-- 
                    {{-- ANCHOR Leads Menu Starts here --}}
                    {{-- @can('viewany-lead', User::class) --}}
                        @if (@$route_active == 'add_lead' || @$route_active == 'manage_lead' || @$route_active == 'lead_title' || @$route_active == 'show_lead' || @$route_active == 'lead_source' || @$route_active == 'lead_status') @php
                          $lead_dd = 'active';
                          $lead_menu_open = 'menu-open';
                        @endphp
@else
                            @php
                              $lead_menu_open = 'menu-close';
                            @endphp @endif
                        <li class="nav-item has-treeview {{ @$lead_menu_open }}">
                            <a href="#" class="nav-link {{ @$lead_dd }}">
                                <i class="nav-icon fas fa-user-clock"></i>
                                <p>
                                {{ __('LEADS') }}
                                    <i class="right fas fa-angle-left"></i>
                                    <span class="badge badge-primary">{{ session('total_leads') }}</span>
                                </p>
                            </a>
    
                            <ul class="nav nav-treeview">
    
                                {{-- @can('create-lead', Auth::user()) --}}
                                    @if ($route_active == 'add_lead')
                                    @php
                                      $add_lead = 'active';
                                    @endphp
                                    @endif
                                    <li class="nav-item">
                                        <a href="{{ url('lead/create') }}" class="nav-link {{ @$add_lead }}">
                                            <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                                            <p style="font-size: 90%;margin-left:2%;">{{ __('NEW LEAD') }}</p>
                                        </a>
                                    </li>
                                 {{-- @endcan --}}
        
                                 {{-- @can('view-lead', Auth::user()) --}}
                                    @if ($route_active == 'manage_lead' || $route_active == 'show_lead')
                                    @php
                                      $manage_lead = 'active';
                                    @endphp
                                    @endif
                                    <li class="nav-item">
                                        <a href="{{ url('lead') }}" class="nav-link {{ @$manage_lead }}">
                                            <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                                            <p style="font-size: 90%;margin-left:2%;">{{ __('MANAGE LEADS') }}</p>
                                        </a>
                                    </li>
                                {{-- @endcan --}}
        
                                    @if ($route_active == 'lead_source')
                                        @php
                                          $lead_source = 'active';
                                        @endphp
                                    @endif
                                    <li class="nav-item">
                                        <a href="{{ url('lead/source') }}" class="nav-link {{ @$lead_source }}">
                                            <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                                            <p style="font-size: 90%;margin-left:2%;">{{ __('LEAD SOURCES') }}</p>
                                        </a>
                                    </li>
        
                                    @if ($route_active == 'lead_status')
                                    @php
                                      $lead_status = 'active';
                                    @endphp
                                    @endif
                                    <li class="nav-item">
                                        <a href="{{ url('lead/status') }}" class="nav-link {{ @$lead_status }}">
                                            <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                                            <p style="font-size: 90%;margin-left:2%;">{{ __('LEAD STATUSESS') }}</p>
                                        </a>
                                    </li>
                            
                            </ul>
                        </li>
                   {{-- @endcan --}} -->

        <!-- {{-- SECTION Product Menu --}}
                    {{-- @can('viewany-product', User::class) --}}
                        @if (@$route_active == 'productCreate' || @$route_active == 'product' || @$route_active == 'productgroup') @php
                          $product_dd = 'active';
                          $product_menu_open = 'menu-open';
                        @endphp
@else
                            @php
                              $product_menu_open = 'menu-close';
                            @endphp @endif
                        <li class="nav-item has-treeview {{ @$product_menu_open }}">
                            <a href="#" class="nav-link {{ @$product_dd }}">
                                <i class="nav-icon fas fa-store"></i>
                                <p>
                                    {{ __('PRODUCTS') }}
                                    <i class="right fas fa-angle-left"></i>
                                    <span class="badge badge-primary">{{ session('total_products') }}</span>
                                </p>
                            </a>
    
                            <ul class="nav nav-treeview">
                            {{-- @can('create-product', Auth::user()) --}}
                                @if ($route_active == 'productCreate')
                                @php
                                  $productCreate = 'active';
                                @endphp
                                @endif
                                <li class="nav-item">
                                    <a href="{{ url('product/create') }}" class="nav-link {{ @$productCreate }}">
                                        <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                                        <p style="font-size: 90%;margin-left:2%;">{{ __('NEW PRODUCT') }}</p>
                                    </a>
                                </li>
                            {{-- @endcan --}}
    
                            {{-- @can('view-product', Auth::user()) --}}
                                @if ($route_active == 'product')
                                @php
                                  $product = 'active';
                                @endphp
                                @endif
                                <li class="nav-item">
                                    <a href="{{ url('product/') }}" class="nav-link {{ @$product }}">
                                        <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                                        <p style="font-size: 90%;margin-left:2%;">{{ __('PRODUCTS') }}</p>
                                    </a>
                                </li>
                            {{-- @endcan --}}
    
                            {{-- @can('view-product', Auth::user()) --}}
                                @if ($route_active == 'productgroup')
                                @php
                                  $productgroup = 'active';
                                @endphp
                                @endif
                                <li class="nav-item">
                                    <a href="{{ url('/product/productgroup') }}" class="nav-link {{ @$productgroup }}">
                                        <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                                        <p style="font-size: 90%;margin-left:2%;">{{ __('GROUPS') }}</p>
                                    </a>
                                </li>
    
                            {{-- @endcan --}}
                            </ul>
                        </li>
                 {{-- @endcan --}} -->

        {{-- proposal --}}
        {{-- @can('viewany-lead', User::class)
        @if (@$route_active == 'proposal' || @$route_active == 'proposalCreate')
        @php
        $proposal_dd = 'active';
        $proposal_menu_open = 'menu-open';
        @endphp
        @else
        @php
        $proposal_menu_open = 'menu-close';
        @endphp
        @endif
        <li class="nav-item has-treeview {{ @$proposal_menu_open }}">
          <a href="#" class="nav-link {{@$proposal_dd}}">
            <i class="nav-icon fas fa-business-time"></i>
            <p>
              {{__('PROPOSALS')}}
              <i class="right fas fa-angle-left"></i>
              <span class="badge badge-primary">{{session('total_proposals')}}</span>
            </p>
          </a>

          <ul class="nav nav-treeview">

            @can('create-lead', Auth::user())
            @if ($route_active == 'proposalCreate')
            @php
            $proposalCreate = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{url('proposal/create')}}" class="nav-link {{@$proposalCreate}}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{__('NEW PROPOSAL')}}</p>
              </a>
            </li>
            @endcan

            @can('view-lead', Auth::user())
            @if ($route_active == 'proposal')
            @php
            $proposal = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{url('proposal/')}}" class="nav-link {{@$proposal}}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{__('PROPOSALS')}}</p>
              </a>
            </li>
            @endcan

          </ul>
        </li>
        @endcan --}}

        {{-- SECTION ESTIMATES Menu --}}
        {{-- @can('viewany-lead', User::class)
        @if (@$route_active == 'estimate' || @$route_active == 'estimateCreate')
        @php
        $estimate_dd = 'active';
        $estimate_menu_open = 'menu-open';
        @endphp
        @else
        @php
        $estimate_menu_open = 'menu-close';
        @endphp
        @endif
        <li class="nav-item has-treeview {{ @$estimate_menu_open }}">
          <a href="#" class="nav-link {{@$estimate_dd}}">
            <i class="nav-icon fas fa-columns"></i>
            <p>
              {{__('ESTIMATES')}}
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">

            @can('viewany-lead', Auth::user())
            @if ($route_active == 'estimateCreate')
            @php
            $estimateCreate = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{url('estimate/create')}}" class="nav-link {{@$estimateCreate}}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{__('NEW ESTIMATE')}}</p>
              </a>
            </li>
            @endcan

            @can('view-lead', Auth::user())
            @if ($route_active == 'estimate')
            @php
            $estimate = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{url('estimate/')}}" class="nav-link {{@$estimate}}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{__('ESTIMATES')}}</p>
              </a>
            </li>
            @endcan
          </ul>
        </li>
        @endcan --}}
        {{-- !SECTION ESTIMATES menu --}}

        {{-- SECTION INVOICES Menu --}}
        {{-- @can('viewany-lead', User::class)
        @if (@$route_active == 'invoice' || @$route_active == 'invoiceCreate')
        @php
        $invoice_dd = 'active';
        $invoice_menu_open = 'menu-open';
        @endphp
        @else
        @php
        $invoice_menu_open = 'menu-close';
        @endphp
        @endif
        <li class="nav-item has-treeview {{ @$invoice_menu_open }}">
          <a href="#" class="nav-link {{@$invoice_dd}}">
            <i class="nav-icon fas fa-money-check"></i>
            <p>
              {{__('INVOICES')}}
              <i class="right fas fa-angle-left"></i>
              <span class="badge badge-primary">{{session('total_invoices')}}</span>
            </p>
          </a>

          <ul class="nav nav-treeview">

            @can('viewany-lead', Auth::user())
            @if ($route_active == 'invoiceCreate')
            @php
            $invoiceCreate = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{url('invoice/create')}}" class="nav-link {{@$invoiceCreate}}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{__('NEW INVOICE')}}</p>
              </a>
            </li>
            @endcan

            @can('viewany-lead', Auth::user())
            @if ($route_active == 'invoice')
            @php
            $invoice = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{url('invoice/')}}" class="nav-link {{@$invoice}}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{__('INVOICES')}}</p>
              </a>
            </li>
            @endcan
          </ul>
        </li>
        @endcan --}}

        {{-- task --}}
        {{-- @can('viewany-lead', User::class)
        @if (@$route_active == 'task')
        @php
        $task_dd = 'active';
        $task_menu_open = 'menu-open';
        @endphp
        @else
        @php
        $task_menu_open = 'menu-close';
        @endphp
        @endif
        <li class="nav-item has-treeview {{ @$task_menu_open }}">
          <a href="{{url('task/')}}" class="nav-link {{@$task_dd}}">
            <i class="nav-icon fas fa-tasks"></i>
            <p>
              {{__('TASKS')}}
            </p>
          </a>
        </li>
        @endcan --}}

        {{-- media --}}
        {{-- @can('viewany-lead', User::class)
        @if (@$route_active == 'media')
        @php
        $media_dd = 'active';
        $media_menu_open = 'menu-open';
        @endphp
        @else
        @php
        $media_menu_open = 'menu-close';
        @endphp
        @endif
        <li class="nav-item has-treeview {{ @$media_menu_open }}">
          <a href="{{url('media/')}}" class="nav-link {{@$media_dd}}">
            <i class="nav-icon fas fa-folder-open"></i>
            <p>
              {{__('MEDIA FILES')}}
            </p>
          </a>
        </li>
        @endcan --}}

        {{-- reminders --}}
        {{-- @can('viewany-lead', User::class)
        @if (@$route_active == 'reminder')
        @php
        $reminder_dd = 'active';
        $reminder_menu_open = 'menu-open';
        @endphp
        @else
        @php
        $reminder_menu_open = 'menu-close';
        @endphp
        @endif
        <li class="nav-item has-treeview {{ @$reminder_menu_open }}">
          <a href="{{url('reminder/')}}" class="nav-link {{@$reminder_dd}}">
            <i class="nav-icon fas fa-business-time"></i>
            <p>{{__('REMINDERS')}}</p>
          </a>
        </li>
        @endcan --}}

        {{-- Office Setting --}}
        {{-- @can('viewany-office', User::class)
        @if (@$route_active == 'taxrate' || @$route_active == 'currency' || @$route_active == 'paymentmode' ||
        @$route_active == 'tech_setting' || @$route_active == 'general_setting')
        @php
        $finance_dd = 'active';
        $finance_menu_open = 'menu-open';
        @endphp
        @else
        @php
        $finance_menu_open = 'menu-close';
        @endphp
        @endif
        <li class="nav-item has-treeview {{ @$finance_menu_open }}">
          <a href="#" class="nav-link {{@$finance_dd}}">
            <i class="nav-icon fas fa-money-check-alt"></i>
            <p>
              {{__('OFFICE SETTINGS')}}
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">

            @can('view-office', Auth::user())
            @if ($route_active == 'taxrate')
            @php
            $taxrate = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{url('/office/taxrate')}}" class="nav-link {{@$taxrate}}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{__('TAX RATES')}}</p>
              </a>
            </li>

            @if ($route_active == 'currency')
            @php
            $currency = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{url('/office/currency')}}" class="nav-link {{@$currency}}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{__('CURRENCIES')}}</p>
              </a>
            </li>

            @if ($route_active == 'paymentmode')
            @php
            $paymentmode = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{url('/office/paymentmode')}}" class="nav-link {{@$paymentmode}}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{__('PAYMENT MODES')}}</p>
              </a>
            </li>

            @if ($route_active == 'general_setting')
            @php
            $general_settings = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{url('/office/general_setting')}}" class="nav-link {{@$general_settings}}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{__('GENERAL SETTINGS')}}</p>
              </a>
            </li>

            @if ($route_active == 'tech_setting')
            @php
            $tech_settings = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{url('/office/tech_setting')}}" class="nav-link {{@$tech_settings}}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{__('SMTP SETTINGS')}}</p>
              </a>
            </li>

            @endcan



          </ul>
        </li>
        @endcan --}}

        {{-- web to lead --}}
        {{-- @can('viewany-office', User::class)
        @if (@$route_active == 'Web to Lead Form' || @$route_active == 'Fields' || @$route_active == 'Create Form')
        @php
        $finance_dd = 'active';
        $finance_menu_open = 'menu-open';
        @endphp
        @else
        @php
        $finance_menu_open = 'menu-close';
        @endphp
        @endif
        <li class="nav-item has-treeview {{ @$finance_menu_open }}">
          <a href="#" class="nav-link {{@$finance_dd}}">
            <i class="nav-icon fas fa-network-wired"></i>
            <p>
              {{__('WEB TO LEAD FORMS')}}
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">

            @if ($route_active == 'Fields')
            @php
            $formfield = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{url('/office/formfield')}}" class="nav-link {{@$formfield}}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{__('FORM FIELDS')}}</p>
              </a>
            </li>


            @if ($route_active == 'Create Form')
            @php
            $create_form = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{url('/office/create_form')}}" class="nav-link {{@$create_form}}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{__('CREATE FORM')}}</p>
              </a>
            </li>

            @if ($route_active == 'Web to Lead Form')
            @php
            $web_form = 'active';
            @endphp
            @endif
            <li class="nav-item">
              <a href="{{url('/office/web_forms')}}" class="nav-link {{@$web_form}}">
                <i class="far fa-folder nav-icon text-secondary" style="margin-left:8%;"></i>
                <p style="font-size: 90%;margin-left:2%;">{{__('FORMS')}}</p>
              </a>
            </li>
          </ul>
        </li>
        @endcan --}}


      </ul>

      <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up"
          aria-hidden="true"></i><span style="font-family:Source Sans Pro;font-weight: bold;"> TOP</span></button>

    </nav>
  </div>
</aside>
<script>
  //Get the button
  var mybutton = document.getElementById("myBtn");

  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function() {
    scrollFunction()
  };

  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      mybutton.style.display = "block";
    } else {
      mybutton.style.display = "none";
    }
  }

  // When the user clicks on the button, scroll to the top of the document
  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
</script>