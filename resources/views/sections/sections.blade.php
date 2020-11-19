@extends('layouts.master')
@section('title')
<title> Sections</title>

@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@toastr_css

@endsection

@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الاقسام</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
	<!--div-->
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                      @can( 'اضافة قسم')
                    <h4 class="card-title mg-b-0">      
             <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافه قسم</a>
                    </h4> @endcan
                  
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                @if ($errors->any())
                <div class="alet alert-danger">
@foreach ($errors->all() as $error )
    <ul>{{ $error }}</ul>
@endforeach
                </div>
                @endif 
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table key-buttons text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">اسم القسم</th>
                                <th class="border-bottom-0">الوصف</th>
                                <th class="border-bottom-0">العمليات</th>
                        



                            </tr>
                        </thead>
                        <tbody>
                            @php  $nom=''; @endphp
                              
                            @foreach ($sections as $section )
                            @php    $nom++ @endphp
                               <tr>
                                <td>@php echo $nom @endphp</td>
                                <td>{{ $section->section_name }}</td>
                                <td>{{ $section->description }}</td>
                                <td>@can( 'حذف قسم')
                                    <form action="{{ route('sections.destroy',$section->id) }}" method="POST" >
                                        @csrf

                                 @method('DELETE')
                                 <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash-o"></i> Delete </button>
                                    </form>
                                    @endcan
                                </td>
                                <td>
                                    @can( 'تعديل قسم')
                                    <a class="modal-effect btn btn-sm btn-info" 
                                     href="#exampleModal2" title="تعديل"  data-id="{{ $section->id }}"
                                      data-section_name="{{ $section->section_name }}"
                                    data-description="{{ $section->description }}"
                                     data-toggle="modal" data-effect="effect-scale">
                                  <i class="las la-pen"></i>Edit</a> @endcan

                                   
                                </td>
                               
                            </tr>
                            @endforeach
                         
                        </tbody>
                    </table>
                </div>
         
            </div>
        </div>
    </div>
    <!-- start modal-->
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافه قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('sections.store')}}" method="post">
                        @csrf

                    <div class="form-group">
                        <label for="exampleInputEmail1">اسم القسم</label>
                        <input type="text" class="form-control" id="section_name" name="section_name"  >
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">ملاحظات</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">تاكيد</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                </div>
                </form>
                </div>
             
            </div>
        </div>
    </div>
    <!-- End Basic modal -->
       <!-- start modal for edit-->
<!-- edit -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <form action="sections/update"   method="post" autocomplete="off">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="hidden" name="id" id="id" value="">
                    <label for="recipient-name" class="col-form-label">اسم القسم:</label>
                    <input class="form-control" name="section_name" id="section_name" type="text">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">ملاحظات:</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">تاكيد</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
        </div>
        </form>
    </div>
</div>
</div>

    
    <!-- End Basic modal -->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
        <!-- main-content closed -->
	
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>

<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script>
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var section_name = button.data('section_name')
        var description = button.data('description')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #section_name').val(section_name);
        modal.find('.modal-body #description').val(description);
    })
</script>

@endsection