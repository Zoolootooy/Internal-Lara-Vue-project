 <div class="row">
     <div class="col-12">
         <div class="page-title-box d-flex align-items-center justify-content-between">
             <h4 class="mb-0 font-size-18">
                 {{ $title ?? null }}@if (!empty($caption)): {{ $caption }}@endif
             </h4>
             <div class="page-title-right">
                 <ol class="breadcrumb m-0">
                     @php $area = __('Dashboard') @endphp
                     <li class="breadcrumb-item active">{{ $area }}</li>
                     @if (isset($header) && $header != $title)
                        <li class="breadcrumb-item active">{{ $header }}</li>
                     @endif
                     @if (isset($title) && $title != $area)
                        <li class="breadcrumb-item">{{ $title ?? null }}</li>
                     @endif
                 </ol>
             </div>
         </div>
     </div>
 </div>