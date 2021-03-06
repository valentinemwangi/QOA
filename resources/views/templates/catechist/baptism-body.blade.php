@if(count($baptisms)===0)
<h5>Sorry, there are no registered sacraments of Baptism.</h5>
<button class="btn btn-sm btn-default pull-left" data-toggle="modal" data-target=".add-baptism"><i class="fa fa-fw fa-pencil"></i> Register New Baptism</button>
@else
@if (Session::has('info-patient'))
<div class="alert alert-info text-center btn-close" role="alert">
  {{ Session::get('info-patient') }}
</div>
@endif
<div class="panel panel-default">
    <div class="panel-heading">
        {!! Form::open(array('route' => 'search-baptism', 'class'=>'form-inline text-right')) !!}
            <div class="form-group">
                <div class="input-group">
                    <input placeholder="Search Appointments" name="search" class="form-control" type="text" required>
                    <div class="input-group-btn"><button class="btn btn-info" type="submit">Search</button></div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm table-responsive">
            
            <thead>
                <tr>
                    <th style="width:10%">Christian Name</th>
                    <th style="width:20%">Family Name</th>
                    <th style="width:10%">Date of Baptism</th>
                    <th style="width:15%">Name of GodParent</th>
                    <th style="width:10%">Minister</th>
                    <th style="width:15%">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($baptisms->reverse() as $baptism)
                <tr>
                    <td>
                        {{ $baptism->christian_name }}
                    </td>
                    <td>
                        {{ $baptism->family_name }}
                    </td>
                    <td>
                        {{ Carbon\Carbon::parse($baptism->date_of_baptism)->diffForHumans() }}
                    </td>
                    <td>
                        {{ $baptism->minister }}
                    </td>
                    <td class="center">
                        <button class="btn btn-xs btn-default"><i class="fa fa-pencil"></i> Edit</button>
                        <button class="btn btn-xs btn-danger" data-toggle="modal" data-target=".baptism-{{$baptism->id}}">
                            Cancel <i class="fa fa-times"></i>
                        </button>
                    </td>
                </tr>
                <div class="modal fade baptism-{{$baptism->id}}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info dk">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h5 class="blue bigger">
                                                    <i class="fa fa-times"></i>
                                                Cancel baptism</h5>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12">
                                                        <p>Are you sure you want to <b>Permanently</b> delete this baptism?</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                            {!!Form::open()!!}
                                                        {!! Form::submit('No, Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']) !!} 
                                                    {!!Form::close()!!}

                                                    {!!Form::open(['method'=>'DELETE','action'=>['Catechist\CatechistController@deleteBaptism',$baptism->id]])!!}
                                                        {!! Form::submit('Yes, Cancel', ['class' => 'btn btn-danger btn-sm pull-right']) !!} 
                                                    {!!Form::close()!!}
                                            </div>
                                        </div>
                            </div><!-- /. modal dialog -->
                    </div><!-- /. modal-->
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="text-center">
            <ul class="pagination"> 
                    {{ $baptisms->links() }}
            </ul>
        </div>
    </div>
    @endif
<!--  Add baptism -->
    <div class="modal fade add-baptism" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info dk">
                    <h4 class="font-thin text-center"> Register New Baptism <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::open(['method'=>'POST', 'action'=>['Catechist\ChristiansController@addChristian']])!!}
                            <div class="form-group col-md-12">
                                <div class="input-group m-b col-md-12">
                                    <input type="text" class="form-control" name="christian_name" placeholder="Christian Name" required>
                                </div>
                                <div class="input-group m-b col-md-12">
                                    <input type="text" class="form-control" name="family_name" placeholder="Family Name" required>
                                </div>
                                <div class="input-group m-b col-md-12">
                                    <input type="text" class="form-control" name="date_of_birth" placeholder="Date of Birth" required>
                                </div>
                                <div class="input-group m-b col-md-12">
                                    <input type="text" class="form-control" name="place_of_birth" placeholder="Place of Birth" required>
                                </div>
                                <div class="input-group m-b col-md-12">
                                    <input type="text" class="form-control" name="parents_or_guardian" placeholder="Parents or Guardian's Name" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light lt">
                    <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                    {!! Form::submit('Register Christian', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                    {!!Form::close()!!}
                </div>
            </div>
            </div><!-- /. modal dialog -->
            </div><!-- /. modal-->
            <!-- Add baptism -->